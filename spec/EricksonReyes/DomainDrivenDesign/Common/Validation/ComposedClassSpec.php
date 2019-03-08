<?php


namespace spec\EricksonReyes\DomainDrivenDesign\Common\Validation;

use EricksonReyes\DomainDrivenDesign\Common\HasComposition;
use EricksonReyes\DomainDrivenDesign\Common\Validation\ComposedClass;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ComposedClassSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->beConstructedWith(new GarbageBag());
        $this->shouldHaveType(ComposedClass::class);
    }

    public function it_returns_false_if_the_object_did_not_implement_HasSingleComposition_interface()
    {
        $this->beConstructedWith(new GarbageBag());
        $this->has(Toy::class)->shouldReturn(false);
    }

    public function it_returns_false_if_the_object_did_not_has_the_class_being_searched_for()
    {
        $shoppingBag = new ShoppingBag();
        $shoppingBag->addItem(new Shoes());

        $this->beConstructedWith($shoppingBag);
        $this->has(Toy::class)->shouldReturn(false);
    }

    public function it_returns_false_if_the_object_has_no_composition_and_did_not_implement_the_interface_being_searched_for()
    {
        $shoes = new Shoes();
        $this->beConstructedWith($shoes);
        $this->has(ForKids::class)->shouldReturn(false);
    }

    public function it_returns_true_if_the_object_implements_the_interface_being_searched_for()
    {
        $toy = new Toy();
        $this->beConstructedWith($toy);
        $this->has(ForKids::class)->shouldReturn(true);
    }

    public function it_returns_true_if_the_object_extends_the_class_being_searched_for()
    {
        $lego = new Lego();

        $this->beConstructedWith($lego);
        $this->has(Toy::class)->shouldReturn(true);
    }

    public function it_returns_true_if_the_object_is_composed_of_the_class_being_searched_for()
    {
        $shoppingBag = new ShoppingBag();
        $legoBox = new Box();
        $lego = new Lego();

        $legoBox->insertItem($lego);
        $shoppingBag->addItem($legoBox);

        $this->beConstructedWith($legoBox);
        $this->has(Lego::class)->shouldReturn(true);
    }

    public function it_returns_true_if_the_object_is_composed_of_another_class_being_searched_for()
    {
        $shoeBox = new Box();
        $shoes = new Shoes();
        $shoeBox->insertItem($shoes);

        $this->beConstructedWith($shoeBox);
        $this->has(Shoes::class)->shouldReturn(true);
    }

    public function it_returns_true_if_the_object_is_composed_of_both_of_the_class_being_searched_for()
    {
        $shoppingBag = new ShoppingBag();
        $anotherShoppingBag = new ShoppingBag();
        $legoBox = new Box();
        $shoeBox = new Box();
        $lego = new Lego();
        $shoes = new Shoes();

        $legoBox->insertItem($lego);
        $shoeBox->insertItem($shoes);
        $anotherShoppingBag->addItem($legoBox);

        $shoppingBag->addItem($shoes);
        $shoppingBag->addItem($shoeBox);
        $shoppingBag->addItem($anotherShoppingBag);

        $this->beConstructedWith($shoppingBag);
        $this->has(Lego::class)->shouldReturn(true);
        $this->has(ForKids::class)->shouldReturn(true);
        $this->has(Shoes::class)->shouldReturn(true);
    }

    public function it_returns_false_if_the_object_is_not_composed_of_the_class_being_searched_for()
    {
        $shoppingBag = new ShoppingBag();
        $legoBox = new Box();
        $shoeBox = new Box();
        $shoes = new Shoes();

        $shoppingBag->addItem($shoes);
        $shoppingBag->addItem($shoeBox);
        $shoppingBag->addItem($legoBox);

        $this->beConstructedWith($shoppingBag);
        $this->has(Toy::class)->shouldReturn(false);
        $this->doesntHave(Toy::class)->shouldReturn(true);
    }

    public function it_extracts_the_class_being_searched_for()
    {
        $shoppingBag = new ShoppingBag();
        $lego = new Lego();
        $legoBox = new Box();
        $shoeBox = new Box();
        $shoes = new Shoes();

        $legoBox->insertItem($lego);
        $shoppingBag->addItem($shoes);
        $shoppingBag->addItem($shoeBox);
        $shoppingBag->addItem($legoBox);

        $this->beConstructedWith($shoppingBag);
        $this->extract(Lego::class)->shouldReturn($lego);
        $this->extract(ForKids::class)->shouldReturn($lego);
    }

    public function it_returns_null_if_the_class_was_not_inherited()
    {
        $shoppingBag = new ShoppingBag();
        $lego = new Lego();
        $legoBox = new Box();
        $shoeBox = new Box();
        $shoes = new Shoes();

        $legoBox->insertItem($lego);
        $shoppingBag->addItem($shoes);
        $shoppingBag->addItem($shoeBox);
        $shoppingBag->addItem($legoBox);

        $this->beConstructedWith($shoppingBag);
        $this->extract(Bicycle::class)->shouldBeNull();
    }
}
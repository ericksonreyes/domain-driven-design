# Class Composition Validator
Let's say you have this class.
```php
class Macbook extends Computer {
    // Codes...
}
```
And you want to test if it is an instance of a Laptop. Then you'd simply want to do this:
```php
if ($macbook instanceof Computer) {
    // Codes...
}
```
It will work. But what if you have these classes.
```php
class Macbook extends Computer {
    // Codes...
}

class Desktop extends Computer {
    public function __construct(CPU $cpu) {
        // Codes...
    }
}

class BoxFullOfComputers {
    public function addComputer(Computer $computer) {
        // Codes...
    }
}
```
And you want to know which instances are composed of CPUs? You want to get the instance that as CPUs?


## Using the HasComposition Interface.
Implement the [EricksonReyes\DomainDrivenDesign\Common\HasComposition](../src/EricksonReyes/DomainDrivenDesign/Common/HasComposition.php) interface to your classes.
```php
class Desktop extends Computer implements EricksonReyes\DomainDrivenDesign\Common\HasComposition {
    
    private $composition = [];
    public function __construct(CPU $cpu) {
        $this->composition[] = $cpu;
    }
    
    public function getComposition() {
        return $this->composition;
    }

}

class Box implements EricksonReyes\DomainDrivenDesign\Common\HasComposition {
    private $composition = [];
    
    public function addItem($item) {
        $this->composition[] = $item;
    }
    
    public function getComposition() {
        return $this->composition;
    }
}

class Truck implements EricksonReyes\DomainDrivenDesign\Common\HasComposition {
    private $composition = [];
    
    public function addCargo(Box $box) {
        $this->composition[] = $box;
    }
    
    public function getComposition() {
        return $this->composition;
    }
}
```

## Using the ComposedClass class.

##### No composition.
```php
$laptop = new Macbook();
$composedClass = new EricksonReyes\DomainDrivenDesign\Common\Validation\ComposedClass($laptop);

print_r( $composedClass->has(CPU:class) ); # Returns false;
print_r( $composedClass->doesntHave(CPU:class) ); # Returns true;
```

##### Has composition.
```php
$desktop = new Desktop();
$composedClass = new EricksonReyes\DomainDrivenDesign\Common\Validation\ComposedClass($desktop);

print_r( $composedClass->has(CPU:class) ); # Returns true;
```

##### Has multiple compositions
```php
$laptop = new Macbook();
$desktop = new Desktop();

$box = new Box();
$box->addItem($laptop);
$box->addItem($desktop);

$composedClass = new EricksonReyes\DomainDrivenDesign\Common\Validation\ComposedClass($box);
print_r( $composedClass->has(CPU:class) ); # Returns true;
```

##### Has nested inner compositions
```php
$truck = new Truck();
$truck->addCargo($box);
$composedClass = new EricksonReyes\DomainDrivenDesign\Common\Validation\ComposedClass($truck);
print_r( $composedClass->has(CPU:class) ); # Returns true;
print_r( $composedClass->has(Box:class) ); # Returns true;
```

#### Extracting a composition
```php
$laptop = new Macbook();
$desktop = new Desktop();

$box = new Box();
$box->addItem($laptop);
$box->addItem($desktop);

$emptyBox = new Box();

$truck = new Truck();
$truck->addCargo($box);
$truck->addCargo($emptyBox);

$composedClass = new EricksonReyes\DomainDrivenDesign\Common\Validation\ComposedClass($truck);
$truck->extract(CPU:class); # Returns $desktop 
```
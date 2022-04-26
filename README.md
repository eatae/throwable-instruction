# Throwable instruction
Package for creating exception instructions

### Example

```php
use Eatae\ThrowableInstructor\ThrowableInstruction;
use Eatae\ThrowableInstructor\Example\EchoInstruction;

try {
    $instructor = (new ThrowableInstruction())->add(new EchoInstruction(1);
    throw new Exception('Example message', 0, $instructor);
} catch (Exception $e) {
    // some action
    echo $e->getMessage();
    // run instructions
    ThrowableInstruction::run($e->getPrevious());
}
```


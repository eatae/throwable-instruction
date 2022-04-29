# Throwable instruction
Package for creating exception instructions

### Example

```php
use Eatae\ThrowableInstruction\ThrowableInstruction;
use Eatae\ThrowableInstruction\Examples\EchoOperation;
use Eatae\ThrowableInstruction\Operator;

try {
    throw new Exception(
        "Example message",
        0,
        (new ThrowableInstruction())->add(new EchoOperation(1))
    );
} catch (Exception $e) {
    // some action
    echo $e->getMessage();
    // run instruction
    Operator::followInstruction($e);
}
```


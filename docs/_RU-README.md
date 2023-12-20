<br>
<h1 align="center">Throwable instruction</h1>

<p align="center">
  <strong>A PHP library for creating Exception Instructions</strong>
</p>
<br>

<p align="center">
  <!-- source code -->
  <a href="https://github.com/eatae/throwable-instruction"><img src="http://img.shields.io/badge/source-eatae/throwable&ndash;instruction-/?color=4682B4" alt="Source Code"></a>
  <!-- downloads -->
  <a href="https://github.com/eatae/throwable-instruction"><img alt="Packagist Downloads" src="https://img.shields.io/packagist/dt/eatae/throwable-instruction?color=9ACD32"></a>
  <!-- release -->
  <a href="https://packagist.org/packages/eatae/throwable-instruction"><img src="https://img.shields.io/packagist/v/eatae/throwable-instruction?color=&label=release" alt="Download Package"></a>
  <!-- php-v -->
  <a href="https://php.net"><img src="https://img.shields.io/packagist/php-v/eatae/throwable-instruction?color=9370DB" alt="PHP Programming Language"></a>
  <!-- licence -->
  <a href="https://github.com"><img alt="GitHub License" src="https://img.shields.io/github/license/eatae/throwable-instruction?color=9ACD32">
</a>
</p>
<br>
<br>

## Описание

**Throwable Instruction** даёт возможность определить дополнительные действия при выбросе Exception в конкретном месте.

<br>

## Простой пример


#### Вызов инструкции для указанного типа Exception

```php
try {
    $instruction = new ThrowableInstruction();
    $operation = new EchoOperation('Some output.');
    /*
     * Throwing an exception with an instruction
     */
    throw new LogicException('Some message.', 0, $instruction->add($operation));
} catch (LogicException $e) {
    echo $e->getMessage();
    /*
     * Call instructions for a specified exception
     */
    Operator::followInstruction($e);
} 
```



#### Вызов инструкции для любого типа Exception

```php
try {
    $instruction = new ThrowableInstruction();
    $operation = new EchoOperation('Some output.');
    /*
     * Throwing an exception with an instruction
     */
    throw new LogicException('Some message.', 0, $instruction->add($operation));
} catch (LogicException $e) {
    echo $e->getMessage();
} finally {
    /*
     * Call instructions for all exceptions
     */
    if (isset($e) && is_subclass_of($e, Exception::class)) {
        Operator::followInstruction($e);
    }
}
```
<br>

## Использование


1. **Создайте класс операции**

```php
class ImportantMessageOperation implements OperationInterface
{
    protected string $message;
    protected int $code;

    public function __construct(string $message, int $code)
    {
        $this->message = $message;
        $this->code = $code;
    }

    public function execute(): void
    {
        echo "Important: {$this->message}. Code: {$this->code}";
    }
}
```



2. **Вызовите метод Operator::followInstruction()**

```php
public function whereExceptionsAreCaught(): void
{
    $object = new \stdClass();
    try {
        /*
         * Some code...
         */
        $this->item->doSomethingElse($object, $this->validator, $this->instruction);
    } catch (Exception $e) {
        $this->logger->log($e->getMessage(), $e->getCode());
    } finally {
        /*
         * Call instructions for all exceptions
         */
        if (isset($e) && is_subclass_of($e, Exception::class)) {
            Operator::followInstruction($e);
        }
    }
}
```



3. **Укажите инструкции для Exception**

- Без инструкций
```php
public function doSomething(object $entity): void
{
    if (!$this->validator->validate($entity)) {
        /*
         *  InvalidArgumentException without instructions
         */
        throw new InvalidArgumentException('Entity is not valid object');
    }
}
```

- С Notice инструкцией
```php
public function doSomethingElse(object $item): void
{
    if (!$this->validator->validate($item)) {
        /*
         * InvalidArgumentException with Notice instructions
         */
        throw new InvalidArgumentException(
            'Item is not valid object',
            0,
            $this->instruction->operation(NoticeMessageOperation::class, ['Invalid values passed'])
        );
    }
}
```

- С Important и CriticalEmail инструкциями
```php
public function doSomethingImportant(object $importantItem): void
{
    if (!$this->validator->validate($importantItem)) {
        /*
         * InvalidArgumentException with Important instructions
         */
        throw new InvalidArgumentException(
            'Important Item is not valid object',
            0,
            $this->instruction
                ->operation(ImportantMessageOperation::class, ['Important values are not valid', 500])
                ->operation(SendCriticalEmailOperation::class, ['Any message text'])
        );
    }
}
```
<br>

## Заключение

Try/catch в различных местах кода или отсутсвие логичной иерархии Exceptions могут усложнить работу с ними. Throwable Instruction не исправит архитектурные проблемы, но может улучшить понимание действий вызванных Exceptions и добавит возможность повторного использование этих действий.
























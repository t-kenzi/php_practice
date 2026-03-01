<!--  -->

<?php
class MyClass{
    protected string $data;
    public function __construct(string $data)
    {
        $this->data = $data;
    }
    public function getData(): string{
        return $this->data;
    }
}

class inherit extends MyClass{
    public function getData(): string
    {
        return "~{$this->data}~";
    }
}

$instance = new inherit("こんにちわ");
echo $instance->getData();
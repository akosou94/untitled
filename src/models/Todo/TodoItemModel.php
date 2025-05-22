<?php

namespace App\models\Todo;

class TodoItemModel
{
    public function __construct(
        public int $id,
        public string $title,
        public bool $done
    ) {
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getIsDone(): bool {
        return $this->done;
    }

    public function toArray(): array {
        return [
            'id'    => $this->getId(),
            'title' => $this->getTitle(),
            'done'  => $this->getIsDone(),
        ];
    }
}
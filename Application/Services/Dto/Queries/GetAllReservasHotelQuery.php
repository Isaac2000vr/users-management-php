<?php

declare(strict_types=1);

final class GetAllReservasHotelQuery
{
    private ?string $search;
    private int $page;
    private int $limit;

    public function __construct(?string $search = null, int $page = 1, int $limit = 20)
    {
        $this->search = $search !== null ? trim($search) : null;
        $this->page = $page > 0 ? $page : 1;
        $this->limit = $limit > 0 ? $limit : 20;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}

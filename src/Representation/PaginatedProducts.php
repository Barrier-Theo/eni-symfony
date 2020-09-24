<?php


namespace App\Representation;


use Doctrine\ORM\Tools\Pagination\Paginator;
use JMS\Serializer\Annotation as Serializer;

class PaginatedProducts
{
    /**
     * @Serializer\Type("array<App\Entity\Product>")
     * @Serializer\Groups("{list}")
     */
    private $data;

    /**
     * @Serializer\Groups("{list}")
     */
    private $meta;

    public function __construct(Paginator $paginator, $page)
    {
        $this->data = iterator_to_array($paginator);
        $this->meta = [
            'page' => $page,
            'items_on_current_page' => count($this->data),
            'total_number_of_items' => count($paginator)
        ];

    }

    /**
     * @return array|Paginator
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array|Paginator $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @param array $meta
     */
    public function setMeta(array $meta): void
    {
        $this->meta = $meta;
    }

}
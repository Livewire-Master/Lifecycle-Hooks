<?php

namespace App\DataTransferObjects\Post;

class PostDto
{
    /**
     * Create a new instance of the class.
     *
     * @param string $title   The title of the instance.
     * @param string $caption The caption of the instance.
     *
     * @return void
     */
    public function __construct(
        public string $title,
        public string $caption,
        public int    $likes,
    ) {}

    /**
     * Create a new instance of the PostDto class using data from an array.
     *
     * @param array $data The data array containing the title and caption.
     *
     * @return PostDto The instance of the PostDto class.
     */
    public static function fromArray(array $data): PostDto
    {
        return new self(
            $data['title'],
            $data['caption'],
            $data['likes'],
        );
    }

    /**
     * Like post
     *
     * @return PostDto
     */
    public function like(): PostDto
    {
        $this->likes++;

        return $this;
    }

    /**
     * Convert the object to an array.
     *
     * @return array The converted array.
     */
    public function toArray(): array
    {
        return [
            'title'   => $this->title,
            'caption' => $this->caption,
            'likes'   => $this->likes,
        ];
    }
}

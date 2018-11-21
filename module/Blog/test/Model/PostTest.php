<?php

namespace PostTest\Model;


use Blog\Model\Post;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{

    public function testPseudoTagIsReplaced()
    {
        $post = new Post('The Title', 'Post text {POST_TITLE}');
        $post->replacePseudoTag();
        $this->assertSame(
            'Post text The Title', $post->getText(),
            '"{POST_TITLE}" in "text" should be replaced with "The Title"'
        );
    }

}

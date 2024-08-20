<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Facades;

use DragonCode\Boosty\Api\Agent;
use DragonCode\Boosty\Api\Author;
use DragonCode\Boosty\Api\Blacklist;
use DragonCode\Boosty\Api\Comment;
use DragonCode\Boosty\Api\Goal;
use DragonCode\Boosty\Api\Image;
use DragonCode\Boosty\Api\Moderation;
use DragonCode\Boosty\Api\Post;
use DragonCode\Boosty\Api\Promo;
use DragonCode\Boosty\Api\Social;
use DragonCode\Boosty\Api\Subscriber;
use DragonCode\Boosty\Api\Subscription;

class Boosty
{
    public static function agents(): Agent
    {
        return new Agent();
    }

    public static function author(): Author
    {
        return new Author();
    }

    public static function blacklist(): Blacklist
    {
        return new Blacklist();
    }

    public static function comments(): Comment
    {
        return new Comment();
    }

    public static function goals(): Goal
    {
        return new Goal();
    }

    public static function moderation(): Moderation
    {
        return new Moderation();
    }

    public static function posts(): Post
    {
        return new Post();
    }

    public static function promo(): Promo
    {
        return new Promo();
    }

    public static function socials(): Social
    {
        return new Social();
    }

    public static function subscribers(): Subscriber
    {
        return new Subscriber();
    }

    public static function subscriptions(): Subscription
    {
        return new Subscription();
    }

    public static function images(): Image
    {
        return new Image();
    }
}

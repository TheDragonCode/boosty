<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Services;

use DragonCode\Boosty\Api\Agent;
use DragonCode\Boosty\Api\Auth;
use DragonCode\Boosty\Api\Blacklist;
use DragonCode\Boosty\Api\Comment;
use DragonCode\Boosty\Api\Goal;
use DragonCode\Boosty\Api\Me;
use DragonCode\Boosty\Api\Media;
use DragonCode\Boosty\Api\Moderation;
use DragonCode\Boosty\Api\Post;
use DragonCode\Boosty\Api\Promo;
use DragonCode\Boosty\Api\Social;
use DragonCode\Boosty\Api\Subscription;
use DragonCode\Boosty\Models\Boosty;

class Manager
{
    public function __construct(
        protected Boosty $model,
        protected Model $repository,
    ) {}

    public function forBlog(string $name): static
    {
        if ($this->model->blog === $name) {
            return $this;
        }

        app()->bind(static::class . ':' . $name, fn () => new static(
            $this->repository->find($name),
            $this->repository
        ));

        return app(static::class . ':' . $name);
    }

    public function auth(): Auth
    {
        return new Auth($this->model->blog, $this->model->access_token);
    }

    public function agents(): Agent
    {
        return new Agent($this->model->blog, $this->model->access_token);
    }

    public function me(): Me
    {
        return new Me($this->model->blog, $this->model->access_token);
    }

    public function blacklist(): Blacklist
    {
        return new Blacklist($this->model->blog, $this->model->access_token);
    }

    public function comments(): Comment
    {
        return new Comment($this->model->blog, $this->model->access_token);
    }

    public function goals(): Goal
    {
        return new Goal($this->model->blog, $this->model->access_token);
    }

    public function moderation(): Moderation
    {
        return new Moderation($this->model->blog, $this->model->access_token);
    }

    public function posts(): Post
    {
        return new Post($this->model->blog, $this->model->access_token);
    }

    public function promo(): Promo
    {
        return new Promo($this->model->blog, $this->model->access_token);
    }

    public function socials(): Social
    {
        return new Social($this->model->blog, $this->model->access_token);
    }

    public function subscriptions(): Subscription
    {
        return new Subscription($this->model->blog, $this->model->access_token);
    }

    public function media(): Media
    {
        return new Media($this->model->blog, $this->model->access_token);
    }
}

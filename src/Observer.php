<?php


interface Notify {
    public function alert(): void;
}

abstract class Observer {
    /**
     * @var array<Notify>
     */
    private $observers = [];
    public function attach(Notify $notify) {
        $this->observers[] = $notify;
        return $this;
    }

    protected function publish() {
        foreach ($this->observers as $key => $value) {
            $value->alert();
        }
    }
}



class Post {
}

class PostService extends Observer {
    public function newPost(Post $post) {
        //create and save a new post 
        $this->publish();
    }
}




class ShareTwitter implements Notify {
    public function alert(): void {
        echo "You have posted the new post on Twitter" . PHP_EOL;
    }
}

class ShareFacebook implements Notify {
    public function alert(): void {
        echo "You have posted the new post on Facebook" . PHP_EOL;
    }
}

class ShareInsta implements Notify {
    public function alert(): void {
        echo "You have posted the new post on Insta" . PHP_EOL;
    }
}


$post = new Post();

$postService = (new PostService())
    ->attach((new ShareTwitter()))
    ->attach((new ShareFacebook()))
    ->attach((new ShareInsta()));

$postService->newPost($post);

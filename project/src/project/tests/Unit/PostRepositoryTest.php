<?php


namespace Tests\Unit;


use App\Http\Dto\PostDto;
use App\Http\Repositories\Classes\PostRepositoryImpl;
use App\Http\Repositories\Interfaces\PostRepository;
use App\Model\Post;
use Tests\TestCase;

use Mockery;

class PostRepositoryTest extends TestCase
{
    private PostRepository $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new PostRepositoryImpl();
    }

    public function setUpReadTest()
    {
        $result =
            [
                "id" => 1,
                "owner_id" => 1,
                "title" => "갑이야",
                "contents" => "을이야",
                "parents_post_id" => null,
                "created_date" => "2006-02-01 00:00:01",
                "updated_date" => "2006-02-01 00:00:01",
            ];
        $mockObj = Mockery::mock();
        $mockObj->allows()->getAttributes()->andReturns($result);
        $post = Mockery::namedMock(Post::class);
        $post->allows()->where('id', 1)->andReturns($post);
        $post->allows()->get()->andReturns([$mockObj]);
    }

    public function testReadTest()
    {
        $this->setUpReadTest();
        $dest = json_encode(new PostDto(
            1,
            1,
            "갑이야",
            "을이야",
            null,
            "2006-02-01 00:00:01",
            "2006-02-01 00:00:01",
        ));
        $result = json_encode($this->repository->read(1));
        $this->assertSame($dest, $result);
    }

    public function setUpReadWithPictureTest(int $id)
    {
        $result =
            [
                "id" => 1,
                "owner_id" => 1,
                "title" => "갑이야",
                "contents" => "을이야",
                "parents_post_id" => null,
                "created_date" => "2006-02-01 00:00:01",
                "updated_date" => "2006-02-01 00:00:01",
            ];
        $mockObj = Mockery::mock();
        $mockObj->allows()->getAttributes()->andReturns($result);
        $post = Mockery::namedMock(Post::class);
        $post->allows()->join('post_picture', 'post_picture.post_id', '=', 'post.id')->andReturns($post);
        $post->allows()->join('picture', 'picture.id', '=', 'picture_id')->andReturns($post);
        $post->allows()->where('picture.id', $id)->andReturns($post);
        $post->allows()->select('post.id as id',
            'post.owner_id as owner_id',
            'title',
            'contents',
            'parents_post_id',
            'post.created_date as created_date',
            'post.updated_date as updated_date'
        )->andReturns($post);
        $post->allows()->get()->andReturns([$mockObj]);
    }

    public function testReadWithPictureTest()
    {
        $id = 3;
        $this->setUpReadWithPictureTest($id);
        $dest = json_encode(
            new PostDto(
                1,
                1,
                "갑이야",
                "을이야",
                null,
                "2006-02-01 00:00:01",
                "2006-02-01 00:00:01",
            )
        );
        $result = json_encode($this->repository->readWithPicture($id)[0]);
        $this->assertSame($dest, $result);
    }
}

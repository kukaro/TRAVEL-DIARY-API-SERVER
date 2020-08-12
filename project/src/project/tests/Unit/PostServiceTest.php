<?php


namespace Tests\Unit;


use App\Http\Dto\PostDto;
use App\Http\Repositories\Classes\PostRepositoryImpl;
use App\Http\Repositories\Interfaces\PostRepository;
use App\Http\Services\Classes\PostServiceImpl;
use App\Http\Services\Interfaces\PostService;
use App\Model\Post;
use Tests\TestCase;

use Mockery;

class PostServiceTest extends TestCase
{
    private PostRepository $repository;
    private PostService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::namedMock(PostRepositoryImpl::class);
        $this->service = new PostServiceImpl($this->repository);
    }

    public function setUpGetTest(int $id)
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
        $this->repository->allows()->read($id)->andReturns(new PostDto(
            1,
            1,
            "갑이야",
            "을이야",
            null,
            "2006-02-01 00:00:01",
            "2006-02-01 00:00:01",
        ));
    }

    public function testGetTest()
    {
        $id = 1;
        $this->setUpGetTest($id);
        $dest = json_encode(new PostDto(
            1,
            1,
            "갑이야",
            "을이야",
            null,
            "2006-02-01 00:00:01",
            "2006-02-01 00:00:01",
        ));
        $result = json_encode($this->service->get(1));
        $this->assertSame($dest, $result);
    }
}

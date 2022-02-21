<?php


namespace App\Http\Queries;

use App\Helpers\DateFormater;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

/**
 * Abstracts complex queries into a single method.
 */
class QueryConstructor
{


    /**
     * CARDS QUERIES
     */


    /**
     * Get most recent posts with user, comments and likes, along with stack info to fullfill the cards. Accepts integer as limit of cards returned. 
     *
     * @param integer $limit
     * @return array
     */
    public function getCardsByMostRecent($limit = 10)
    {

        $cardData = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('stacks', 'stacks.id', '=', 'posts.stack_id')
            ->select('posts.id', 'posts.title', 'posts.description', 'posts.created_at', 'users.name as user_name', 'users.image as user_image', 'stacks.name as stack_name', 'stacks.image as stack_image')
            ->orderBy('posts.created_at', 'desc')
            ->limit($limit)
            ->get();

        // Bring number of comments and likes for each post.
        $posts = Post::withCount('comments')->latest()->limit($limit)->get();
        $likes = Post::withCount('likes')->latest()->limit($limit)->get();

        // Append number of comments and likes to each row
        $cardData = $cardData->map(function ($card) use ($posts, $likes) {
            $card->comments_count = $posts->where('id', $card->id)->first()['comments_count'];
            $card->likes_count = $likes->where('id', $card->id)->first()['likes_count'];
            return $card;
        });
        /**
         * Using custom DateFormater class to serve json formatted data. 
         */
        $cardData = DateFormater::dateDiff($cardData);

        $data = [
            'cardData' => $cardData,
        ];

        return $data;
    }

    public function getCardsByUser($id)
    {

        $cardData = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('stacks', 'stacks.id', '=', 'posts.stack_id')
            ->select('posts.id', 'posts.title', 'posts.description', 'posts.created_at', 'users.name as user_name', 'users.image as user_image', 'stacks.name as stack_name', 'stacks.image as stack_image')
            ->where('posts.user_id', $id)
            ->orderBy('posts.created_at', 'desc')
            ->get();

        // Bring number of comments and likes for each post.
        $posts = Post::withCount('comments')->where('user_id', $id)->latest()->get();
        $likes = Post::withCount('likes')->where('user_id', $id)->latest()->get();

        // Append number of comments and likes to each row
        $cardData = $cardData->map(function ($card) use ($posts, $likes) {
            $card->comments_count = $posts->where('id', $card->id)->first()['comments_count'];
            $card->likes_count = $likes->where('id', $card->id)->first()['likes_count'];
            return $card;
        });
        /**
         * Using custom DateFormater class to serve json formatted data. 
         */
        $cardData = DateFormater::dateDiff($cardData);

        $data = [
            'cardData' => $cardData,
        ];

        return $data;
    }

    public function getCardsByRecentWithPagination($pagination = 6)
    {

        $cardData = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('stacks', 'stacks.id', '=', 'posts.stack_id')
            ->select('posts.id', 'posts.title', 'posts.description', 'posts.created_at', 'users.name as user_name', 'users.image as user_image', 'stacks.name as stack_name', 'stacks.image as stack_image')
            ->orderBy('posts.created_at', 'desc')
            ->paginate($pagination);


        // Bring number of comments and likes for each post.
        $posts = Post::withCount('comments')->latest()->paginate($pagination);
        $likes = Post::withCount('likes')->latest()->paginate($pagination);

        // Append number of comments and likes to each row
        $cardData = $cardData->map(function ($card) use ($posts, $likes) {
            $card->comments_count = $posts->where('id', $card->id)->first()['comments_count'];
            $card->likes_count = $likes->where('id', $card->id)->first()['likes_count'];
            return $card;
        });
        /**
         * Using custom DateFormater class to serve json formatted data. 
         */
        $cardData = DateFormater::dateDiff($cardData);

        $data = [
            'cardData' => $cardData,
        ];

        return $data;
    }
}

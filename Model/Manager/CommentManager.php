<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Comment;
use App\Model\Entity\Video;

class CommentManager
{
    public const TABLE = '2310_comment';

    public static function makeComment(array $data): Comment
    {
        return (new Comment())
            ->setId($data['id'])
            ->setContent($data['content'])
            ->setAuthor(UserManager::getUser($data['user_fk']))
            ->setVideo(VideoManager::getVideo($data['video_fk']))
            ;
    }

    public static function getAll(): array
    {
        $comments = [];
        $request = DB::getPDO()->query("SELECT * FROM " . self::TABLE);

        if ($request) {
            foreach ($request->fetchAll() as $data) {
                $comments[] = self::makeComment($data);
            }
        }
        return $comments;
    }

    public static function addComment(string $content, int $user_fk, int $video_fk): void
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO " . self::TABLE . " (content, user_fk, video_fk)
            VALUES (:content, :author, :video)
        ");

        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':author', $user_fk);
        $stmt->bindValue(':video', $video_fk);

        $stmt->execute();
    }

    public static function commentExist(int $id): bool
    {
        $result = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $result ? $result->fetch()['cnt'] : 0;
    }

    public static function deleteComment(int $id): bool
    {
        $query = DB::getPDO()->exec("DELETE FROM " . self::TABLE . " WHERE id = $id");
        if ($query) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function getCommentByVideo(Video $video): array
    {
        $comments = [];
        $query = DB::getPDO()->query("
            SELECT * FROM " . self::TABLE . " WHERE video_fk = " . $video->getId() ." ORDER BY id DESC
        ");

        if ($query) {
            foreach ($query->fetchAll() as $commentData) {
                $comments[] = (new Comment())
                    ->setId($commentData['id'])
                    ->setContent($commentData['content'])
                    ->setAuthor(UserManager::getUser($commentData['user_fk']))
                    ->setVideo(VideoManager::getVideo($commentData['video_fk']))
                ;
            }
        }
        return $comments;
    }

    public static function getCommentById(int $id): ?Comment
    {
        $result = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $result ? self::makeComment($result->fetch()) : null;
    }
}

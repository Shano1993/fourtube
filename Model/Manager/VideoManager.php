<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Video;

class VideoManager
{
    public const TABLE = '2310_video';

    public static function makeVideo(array $data): Video
    {
        return (new Video())
            ->setId($data['id'])
            ->setTitle($data['title'])
            ->setContent($data['content'])
            ->setVideoName($data['video_name'])
            ->setAuthor(UserManager::getUser($data['user_fk']))
            ;
    }

    public static function getAll(): array
    {
        $videos = [];
        $request = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " ORDER BY id DESC");

        if ($request) {
            foreach ($request->fetchAll() as $data) {
                $videos[] = self::makeVideo($data);
            }
        }
        return $videos;
    }

    public static function getVideo(int $id): ?Video
    {
        $result = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $result ? self::makeVideo($result->fetch()) : null;
    }

    public static function addNewVideo(Video &$video): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO " . self::TABLE . " (title, content, video_name, user_fk)
            VALUES (:title, :content, :videoName, :author)
        ");

        $stmt->bindValue(':title', $video->getTitle());
        $stmt->bindValue(':content', $video->getContent());
        $stmt->bindValue(':videoName', $video->getVideoName());
        $stmt->bindValue(':author', $video->getAuthor()->getId());

        $result = $stmt->execute();
        $video->setId(DB::getPDO()->lastInsertId());
        return $result;
    }

    public static function videoExist(int $id): bool
    {
        $result = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $result ? $result->fetch(['cnt']) : 0;
    }

    public static function deleteVideo(Video $video): bool
    {
        if (self::videoExist($video->getId())) {
            return DB::getPDO()->exec("DELETE FROM " . self::TABLE . " WHERE id = {$video->getId()}");
        }
        return false;
    }
}

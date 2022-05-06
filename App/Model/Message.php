<?php
namespace App\Model;

use Base\Db;

class Message
{
  private $id;
  private $text;
  private $createdAt;
  private $authorId;
  /** @var User */
  private $author;
  private $image;

  public function __construct(array $data)
  {
    $this->text = $data['text'];
    $this->createdAt = $data['created_at'];
    $this->authorId = $data['author_id'];
    $this->image = $data['image'] ?? '';
  }

  public static function deleteMessage(int $messageId)
  {
    $db = Db::getInstance();
    $query = "DELETE FROM messages1 WHERE id = $messageId";
    return $db->exec($query, __METHOD__);
  }

  public function save()
  {
    $db = Db::getInstance();
    $res = $db->exec(
      'INSERT INTO messages1 (
          text, 
          created_at,
          author_id,
          image
        ) VALUES (
          :text, 
          :created_at, 
          :author_id,
          :image
        )',
      __FILE__,
      [
        ':text' => $this->text,
        ':created_at' => $this->createdAt,
        ':author_id' => $this->authorId,
        ':image' => $this->image,
      ]
      );
    // d($res);
    return $res;
  }

  public static function getList(int $limit = 10, int $offset = 0): array
  {
    $db = Db::getInstance();
    $data = $db->fetchAll(
      "SELECT * FROM messages1 LIMIT $limit OFFSET $offset",
      __METHOD__,
    );

    if(!$data) {
      return [];
    }

    $messages = [];
    foreach($data as $elem) {
      $message = new self($elem);
      $message->id = $elem['id'];
      $messages[] = $message;
    }

    return $messages;
  }

  public static function getUserMessages(int $UserId, int $limit): array
  {
    $db = Db::getInstance();
    $data = $db->fetchAll(
      "SELECT * FROM messages1 WHERE author_id = $UserId LIMIT $limit",
      __METHOD__,
    );

    if(!$data) {
      return [];
    }

    $messages = [];
    foreach($data as $elem) {
      $message = new self($elem);
      $message->id = $elem['id'];
      $messages[] = $message;
    }

    return $messages;
  }

  /** 
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  public function getText(): string
  {
    return $this->text;
  }

  /** @return mixed */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  public function getAuthorId(): int
  {
    return $this->authorId;
  }

  /**
   * @return User
   */

  public function getAuthor(): User
  {
    return $this->author;
  }

    /**
   * @param User $author
   */

  public function setAuthor(User $author): void
  {
    $this->author = $author;
  }

  public function loadFile(string $file)
  {

    if (file_exists($file)) {
      $this->image = $this->genFileName();
      move_uploaded_file($file, getcwd() . '/images/' . $this->image);
    }
  }

  public function genFileName()
  {
    return sha1(microtime(1) . mt_rand(1, 1000000)) . '.jpg';
  }

    /** 
   * @return mixed
   */
  public function getimage()
  {
    return $this->image;
  }

  public function getData()
  {
    return [
      'id' => $this->id,
      'author_id' => $this->author_id,
      'text' => $this->text,
      'created_at' => $this->created_at,
      'image' => $this->image,
    ];
  }
}

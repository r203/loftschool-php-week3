<?php
namespace App\Model;

use Base\Db;

class User
{
  private $id;
  private $name;
  private $createdAt;
  private $password;
  private $email;

  public function __construct(array $data)
  {
    $this->name = $data['name'];
    $this->password = $data['password'];
    $this->createdAt = $data['created_at'];
    $this->email = $data['email'];
  }

  public static function getByEmail(string $email): ?self
  {
    $db = Db::getInstance();
    $data = $db->fetchOne(
      "SELECT * FROM users1 WHERE email = :email", 
      __METHOD__, 
      [':email' => $email]);

    if (!$data) {
      return null;
    }

    $user = new self($data);
    $user->id = $data['id'];
    return $user;
  }

  public static function getByIDs(array $userIds)
  {
    $db = Db::getInstance();
    $idsString = implode(',', $userIds);
    $data = $db->fetchAll(
      "SELECT * FROM users1 WHERE id IN ($idsString)",
      __METHOD__,
    );

    if(!$data) {
      return [];
    }

    $users = [];
    foreach($data as $elem) {
      $user = new self($elem);
      $user->id = $elem['id'];
      $users[$user->id] = $user;
    }

    return $users;
  }

  public function save()
  {
    $db = Db::getInstance();
    $res = $db->exec(
      'INSERT INTO users1 (
          name, 
          password, 
          created_at,
          email
        ) VALUES (
          :name, 
          :password,
          :created_at, 
          :email
        )',
      __FILE__,
      [
        ':name' => $this->name,
        ':password' => self::getPasswordHash($this->password),
        ':created_at' => $this->createdAt,
        ':email' => $this->email,
      ]
      );

      $this->id = $db->lastInsertId();

      return $res;
  }

  public static function getByID(int $id): ?self
  {
    $db = Db::getInstance();
    $data = $db->fetchOne("SELECT * FROM users1 WHERE id = :id", __METHOD__, [':id' => $id]);
    if (!$data) {
      return null;
    }

    $user = new self($data);
    $user->id = $id;
    return $user;
  }

  public static function getList(int $limit = 10, int $offset = 0): array
  {
    $db = Db::getInstance();
    $data = $db->fetchAll(
      "SELECT * FROM users1 LIMIT $limit OFFSET $offset",
      __METHOD__,
    );

    if(!$data) {
      return [];
    }

    $users = [];
    foreach($data as $elem) {
      $user = new self($elem);
      $user->id = $elem['id'];
      $users[] = $user;
    }

    return $users;
  }

  public static function getPasswordHash($password)
  {
    return sha1('qwe' . $password);
  }

  /** 
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function isAdmin(): bool
  {
    return in_array($this->id, ADMIN_IDS);
  }

}

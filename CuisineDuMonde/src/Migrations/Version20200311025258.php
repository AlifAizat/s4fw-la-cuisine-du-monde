<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311025258 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cuisine (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, category_id INT NOT NULL, type_id INT NOT NULL, name VARCHAR(120) NOT NULL, datepublished DATE NOT NULL, ingredients LONGTEXT NOT NULL, recipe LONGTEXT NOT NULL, image VARCHAR(50) DEFAULT NULL, visibility TINYINT(1) NOT NULL, INDEX IDX_10D52C6B61220EA6 (creator_id), INDEX IDX_10D52C6B12469DE2 (category_id), INDEX IDX_10D52C6BC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, description VARCHAR(700) NOT NULL, image VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reply (id INT AUTO_INCREMENT NOT NULL, target_id INT NOT NULL, datewritten DATE NOT NULL, comment VARCHAR(2000) NOT NULL, INDEX IDX_FDA8C6E0158E0B66 (target_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, user_id INT NOT NULL, datewritten DATE NOT NULL, comment VARCHAR(2000) NOT NULL, INDEX IDX_9474526C7294869C (article_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `like` (id INT AUTO_INCREMENT NOT NULL, liker_id INT NOT NULL, likedcuisine_id INT NOT NULL, INDEX IDX_AC6340B3979F103A (liker_id), INDEX IDX_AC6340B34594C0B4 (likedcuisine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creator (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, datecreated DATE NOT NULL, folder VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_BC06EA63E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cuisine ADD CONSTRAINT FK_10D52C6B61220EA6 FOREIGN KEY (creator_id) REFERENCES creator (id)');
        $this->addSql('ALTER TABLE cuisine ADD CONSTRAINT FK_10D52C6B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE cuisine ADD CONSTRAINT FK_10D52C6BC54C8C93 FOREIGN KEY (type_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E0158E0B66 FOREIGN KEY (target_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES cuisine (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES creator (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3979F103A FOREIGN KEY (liker_id) REFERENCES creator (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B34594C0B4 FOREIGN KEY (likedcuisine_id) REFERENCES cuisine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B34594C0B4');
        $this->addSql('ALTER TABLE cuisine DROP FOREIGN KEY FK_10D52C6B12469DE2');
        $this->addSql('ALTER TABLE reply DROP FOREIGN KEY FK_FDA8C6E0158E0B66');
        $this->addSql('ALTER TABLE cuisine DROP FOREIGN KEY FK_10D52C6BC54C8C93');
        $this->addSql('ALTER TABLE cuisine DROP FOREIGN KEY FK_10D52C6B61220EA6');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3979F103A');
        $this->addSql('DROP TABLE cuisine');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE reply');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE `like`');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE creator');
    }
}

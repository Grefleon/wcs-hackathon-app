<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200625153733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE experience_list (id INT AUTO_INCREMENT NOT NULL, reason VARCHAR(255) NOT NULL, amount INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_experience_list (user_id INT NOT NULL, experience_list_id INT NOT NULL, INDEX IDX_2045B8AA76ED395 (user_id), INDEX IDX_2045B8A7885FD19 (experience_list_id), PRIMARY KEY(user_id, experience_list_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_experience_list ADD CONSTRAINT FK_2045B8AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_experience_list ADD CONSTRAINT FK_2045B8A7885FD19 FOREIGN KEY (experience_list_id) REFERENCES experience_list (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_experience_list DROP FOREIGN KEY FK_2045B8A7885FD19');
        $this->addSql('DROP TABLE experience_list');
        $this->addSql('DROP TABLE user_experience_list');
    }
}

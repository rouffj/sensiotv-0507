<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708083219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add column User::roles as nullable';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_794381C6A76ED395');
        $this->addSql('DROP INDEX IDX_794381C68F93B6FC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__review AS SELECT id, movie_id, user_id, rating, content FROM review');
        $this->addSql('DROP TABLE review');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, movie_id INTEGER NOT NULL, user_id INTEGER NOT NULL, rating DOUBLE PRECISION NOT NULL, content CLOB DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_794381C68F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO review (id, movie_id, user_id, rating, content) SELECT id, movie_id, user_id, rating, content FROM __temp__review');
        $this->addSql('DROP TABLE __temp__review');
        $this->addSql('CREATE INDEX IDX_794381C6A76ED395 ON review (user_id)');
        $this->addSql('CREATE INDEX IDX_794381C68F93B6FC ON review (movie_id)');
        $this->addSql('ALTER TABLE user ADD COLUMN roles CLOB DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_794381C68F93B6FC');
        $this->addSql('DROP INDEX IDX_794381C6A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__review AS SELECT id, movie_id, user_id, rating, content FROM review');
        $this->addSql('DROP TABLE review');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, movie_id INTEGER NOT NULL, user_id INTEGER NOT NULL, rating DOUBLE PRECISION NOT NULL, content CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO review (id, movie_id, user_id, rating, content) SELECT id, movie_id, user_id, rating, content FROM __temp__review');
        $this->addSql('DROP TABLE __temp__review');
        $this->addSql('CREATE INDEX IDX_794381C68F93B6FC ON review (movie_id)');
        $this->addSql('CREATE INDEX IDX_794381C6A76ED395 ON review (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, first_name, last_name, email, phone, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(15) DEFAULT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, first_name, last_name, email, phone, password) SELECT id, first_name, last_name, email, phone, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}

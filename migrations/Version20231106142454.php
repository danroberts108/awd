<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231106142454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, movie_id INT NOT NULL, rating INT NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_794381C6F675F31B (author_id), INDEX IDX_794381C68F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C68F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE review_rating DROP FOREIGN KEY FK_52FF61E23E2E969B');
        $this->addSql('ALTER TABLE review_rating DROP FOREIGN KEY FK_52FF61E2A76ED395');
        $this->addSql('DROP TABLE review_rating');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D88926228F93B6FC');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622F675F31B');
        $this->addSql('DROP INDEX IDX_D88926228F93B6FC ON rating');
        $this->addSql('DROP INDEX IDX_D8892622F675F31B ON rating');
        $this->addSql('ALTER TABLE rating ADD review_id INT NOT NULL, ADD user_id INT NOT NULL, DROP author_id, DROP movie_id, DROP comment');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926223E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D88926223E2E969B ON rating (review_id)');
        $this->addSql('CREATE INDEX IDX_D8892622A76ED395 ON rating (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D88926223E2E969B');
        $this->addSql('CREATE TABLE review_rating (id INT AUTO_INCREMENT NOT NULL, review_id INT NOT NULL, user_id INT NOT NULL, rating INT NOT NULL, INDEX IDX_52FF61E23E2E969B (review_id), INDEX IDX_52FF61E2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE review_rating ADD CONSTRAINT FK_52FF61E23E2E969B FOREIGN KEY (review_id) REFERENCES rating (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE review_rating ADD CONSTRAINT FK_52FF61E2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6F675F31B');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C68F93B6FC');
        $this->addSql('DROP TABLE review');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('DROP INDEX IDX_D88926223E2E969B ON rating');
        $this->addSql('DROP INDEX IDX_D8892622A76ED395 ON rating');
        $this->addSql('ALTER TABLE rating ADD author_id INT NOT NULL, ADD movie_id INT NOT NULL, ADD comment LONGTEXT NOT NULL, DROP review_id, DROP user_id');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926228F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622F675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D88926228F93B6FC ON rating (movie_id)');
        $this->addSql('CREATE INDEX IDX_D8892622F675F31B ON rating (author_id)');
    }
}

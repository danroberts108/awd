<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102104009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE review_rating (id INT AUTO_INCREMENT NOT NULL, review_id INT NOT NULL, user_id INT NOT NULL, rating INT NOT NULL, INDEX IDX_52FF61E23E2E969B (review_id), INDEX IDX_52FF61E2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE review_rating ADD CONSTRAINT FK_52FF61E23E2E969B FOREIGN KEY (review_id) REFERENCES rating (id)');
        $this->addSql('ALTER TABLE review_rating ADD CONSTRAINT FK_52FF61E2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review_rating DROP FOREIGN KEY FK_52FF61E23E2E969B');
        $this->addSql('ALTER TABLE review_rating DROP FOREIGN KEY FK_52FF61E2A76ED395');
        $this->addSql('DROP TABLE review_rating');
    }
}

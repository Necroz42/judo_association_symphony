<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260519143713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_session ADD coach_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE training_session ADD CONSTRAINT FK_D7A45DA3C105691 FOREIGN KEY (coach_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D7A45DA3C105691 ON training_session (coach_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_session DROP FOREIGN KEY FK_D7A45DA3C105691');
        $this->addSql('DROP INDEX IDX_D7A45DA3C105691 ON training_session');
        $this->addSql('ALTER TABLE training_session DROP coach_id');
    }
}

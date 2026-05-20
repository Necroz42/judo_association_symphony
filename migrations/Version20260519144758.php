<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260519144758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_session ADD day DATE NOT NULL, ADD start_time TIME NOT NULL, ADD end_time TIME NOT NULL, DROP start_date, DROP end_date, CHANGE coach_id coach_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_session ADD start_date DATETIME NOT NULL, ADD end_date DATETIME NOT NULL, DROP day, DROP start_time, DROP end_time, CHANGE coach_id coach_id INT DEFAULT NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260518194929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fight ADD winner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA44565DFCD4B8 FOREIGN KEY (winner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_21AA44565DFCD4B8 ON fight (winner_id)');
        $this->addSql('ALTER TABLE user ADD victories INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fight DROP FOREIGN KEY FK_21AA44565DFCD4B8');
        $this->addSql('DROP INDEX IDX_21AA44565DFCD4B8 ON fight');
        $this->addSql('ALTER TABLE fight DROP winner_id');
        $this->addSql('ALTER TABLE user DROP victories');
    }
}

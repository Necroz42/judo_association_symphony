<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260518195046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fight ADD opponent1_id INT DEFAULT NULL, ADD opponent2_id INT DEFAULT NULL, DROP opponent1, DROP opponent2');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA44565976D600 FOREIGN KEY (opponent1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fight ADD CONSTRAINT FK_21AA44564BC379EE FOREIGN KEY (opponent2_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_21AA44565976D600 ON fight (opponent1_id)');
        $this->addSql('CREATE INDEX IDX_21AA44564BC379EE ON fight (opponent2_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fight DROP FOREIGN KEY FK_21AA44565976D600');
        $this->addSql('ALTER TABLE fight DROP FOREIGN KEY FK_21AA44564BC379EE');
        $this->addSql('DROP INDEX IDX_21AA44565976D600 ON fight');
        $this->addSql('DROP INDEX IDX_21AA44564BC379EE ON fight');
        $this->addSql('ALTER TABLE fight ADD opponent1 INT NOT NULL, ADD opponent2 INT NOT NULL, DROP opponent1_id, DROP opponent2_id');
    }
}

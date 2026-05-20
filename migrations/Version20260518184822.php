<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260518184822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE training_session (id INT AUTO_INCREMENT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, location VARCHAR(255) NOT NULL, activity_id INT NOT NULL, INDEX IDX_D7A45DA81C06096 (activity_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_training_session (user_id INT NOT NULL, training_session_id INT NOT NULL, INDEX IDX_706F0707A76ED395 (user_id), INDEX IDX_706F0707DB8156B9 (training_session_id), PRIMARY KEY (user_id, training_session_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE training_session ADD CONSTRAINT FK_D7A45DA81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE user_training_session ADD CONSTRAINT FK_706F0707A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_training_session ADD CONSTRAINT FK_706F0707DB8156B9 FOREIGN KEY (training_session_id) REFERENCES training_session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY `FK_D044D5D481C06096`');
        $this->addSql('ALTER TABLE user_session DROP FOREIGN KEY `FK_8849CBDE613FECDF`');
        $this->addSql('ALTER TABLE user_session DROP FOREIGN KEY `FK_8849CBDEA76ED395`');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user_session');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, location VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, activity_id INT NOT NULL, INDEX IDX_D044D5D481C06096 (activity_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_session (user_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_8849CBDEA76ED395 (user_id), INDEX IDX_8849CBDE613FECDF (session_id), PRIMARY KEY (user_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT `FK_D044D5D481C06096` FOREIGN KEY (activity_id) REFERENCES activity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_session ADD CONSTRAINT `FK_8849CBDE613FECDF` FOREIGN KEY (session_id) REFERENCES session (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_session ADD CONSTRAINT `FK_8849CBDEA76ED395` FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training_session DROP FOREIGN KEY FK_D7A45DA81C06096');
        $this->addSql('ALTER TABLE user_training_session DROP FOREIGN KEY FK_706F0707A76ED395');
        $this->addSql('ALTER TABLE user_training_session DROP FOREIGN KEY FK_706F0707DB8156B9');
        $this->addSql('DROP TABLE training_session');
        $this->addSql('DROP TABLE user_training_session');
    }
}

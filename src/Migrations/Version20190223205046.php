<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190223205046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, comment LONGTEXT DEFAULT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE application_job (application_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_75E7356C3E030ACD (application_id), INDEX IDX_75E7356CBE04EA9 (job_id), PRIMARY KEY(application_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, pass_word VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application_job ADD CONSTRAINT FK_75E7356C3E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE application_job ADD CONSTRAINT FK_75E7356CBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE application_job DROP FOREIGN KEY FK_75E7356C3E030ACD');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE application_job');
        $this->addSql('DROP TABLE user');
    }
}

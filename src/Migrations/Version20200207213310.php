<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200207213310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE horse ADD infrastructure INT DEFAULT NULL, ADD breed INT NOT NULL');
        $this->addSql('ALTER TABLE horse ADD CONSTRAINT FK_629A2F18D129B190 FOREIGN KEY (infrastructure) REFERENCES infrastructure (infrastructure_id)');
        $this->addSql('ALTER TABLE horse ADD CONSTRAINT FK_629A2F18F8AF884F FOREIGN KEY (breed) REFERENCES breed (breed_id)');
        $this->addSql('CREATE INDEX IDX_629A2F18D129B190 ON horse (infrastructure)');
        $this->addSql('CREATE INDEX IDX_629A2F18F8AF884F ON horse (breed)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE horse DROP FOREIGN KEY FK_629A2F18D129B190');
        $this->addSql('ALTER TABLE horse DROP FOREIGN KEY FK_629A2F18F8AF884F');
        $this->addSql('DROP INDEX IDX_629A2F18D129B190 ON horse');
        $this->addSql('DROP INDEX IDX_629A2F18F8AF884F ON horse');
        $this->addSql('ALTER TABLE horse DROP infrastructure, DROP breed');
    }
}

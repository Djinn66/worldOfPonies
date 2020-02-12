<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200207170538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE horse ADD player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE horse ADD CONSTRAINT FK_629A2F1899E6F5DF FOREIGN KEY (player_id) REFERENCES player (player_id)');
        $this->addSql('CREATE INDEX IDX_629A2F1899E6F5DF ON horse (player_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE horse DROP FOREIGN KEY FK_629A2F1899E6F5DF');
        $this->addSql('DROP INDEX IDX_629A2F1899E6F5DF ON horse');
        $this->addSql('ALTER TABLE horse DROP player_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212214051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item ADD infrastruture INT DEFAULT NULL, ADD contest INT DEFAULT NULL, ADD itemFamily INT NOT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E9D2207F6 FOREIGN KEY (infrastruture) REFERENCES infrastructure (infrastructure_id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E2D5D321 FOREIGN KEY (itemFamily) REFERENCES item_family (item_family_id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E1A95CB5 FOREIGN KEY (contest) REFERENCES contest (contest_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E9D2207F6 ON item (infrastruture)');
        $this->addSql('CREATE INDEX IDX_1F1B251E2D5D321 ON item (itemFamily)');
        $this->addSql('CREATE INDEX IDX_1F1B251E1A95CB5 ON item (contest)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E9D2207F6');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E2D5D321');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E1A95CB5');
        $this->addSql('DROP INDEX IDX_1F1B251E9D2207F6 ON item');
        $this->addSql('DROP INDEX IDX_1F1B251E2D5D321 ON item');
        $this->addSql('DROP INDEX IDX_1F1B251E1A95CB5 ON item');
        $this->addSql('ALTER TABLE item DROP infrastruture, DROP contest, DROP itemFamily');
    }
}

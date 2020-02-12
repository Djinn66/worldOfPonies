<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200207172051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contest_player_list (Players INT NOT NULL, Contests INT NOT NULL, INDEX IDX_64B04E9AE9F37A3A (Players), INDEX IDX_64B04E9A59724302 (Contests), PRIMARY KEY(Players, Contests)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contest_player_list ADD CONSTRAINT FK_64B04E9AE9F37A3A FOREIGN KEY (Players) REFERENCES player (player_id)');
        $this->addSql('ALTER TABLE contest_player_list ADD CONSTRAINT FK_64B04E9A59724302 FOREIGN KEY (Contests) REFERENCES contest (contest_id)');
        $this->addSql('ALTER TABLE horse DROP FOREIGN KEY FK_629A2F1899E6F5DF');
        $this->addSql('DROP INDEX IDX_629A2F1899E6F5DF ON horse');
        $this->addSql('ALTER TABLE horse CHANGE player_id player INT DEFAULT NULL');
        $this->addSql('ALTER TABLE horse ADD CONSTRAINT FK_629A2F1898197A65 FOREIGN KEY (player) REFERENCES player (player_id)');
        $this->addSql('CREATE INDEX IDX_629A2F1898197A65 ON horse (player)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contest_player_list');
        $this->addSql('ALTER TABLE horse DROP FOREIGN KEY FK_629A2F1898197A65');
        $this->addSql('DROP INDEX IDX_629A2F1898197A65 ON horse');
        $this->addSql('ALTER TABLE horse CHANGE player player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE horse ADD CONSTRAINT FK_629A2F1899E6F5DF FOREIGN KEY (player_id) REFERENCES player (player_id)');
        $this->addSql('CREATE INDEX IDX_629A2F1899E6F5DF ON horse (player_id)');
    }
}

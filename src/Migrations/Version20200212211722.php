<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212211722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE newspaper_advertisement_list (newspapers INT NOT NULL, advertisements INT NOT NULL, INDEX IDX_7BDA9B421F130BF8 (newspapers), INDEX IDX_7BDA9B425C755F1E (advertisements), PRIMARY KEY(newspapers, advertisements)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE newspaper_advertisement_list ADD CONSTRAINT FK_7BDA9B421F130BF8 FOREIGN KEY (newspapers) REFERENCES newspaper (newspaper_id)');
        $this->addSql('ALTER TABLE newspaper_advertisement_list ADD CONSTRAINT FK_7BDA9B425C755F1E FOREIGN KEY (advertisements) REFERENCES advertisement (advertisement_id)');
        $this->addSql('ALTER TABLE horse CHANGE breed breed INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction CHANGE player player INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE newspaper_advertisement_list');
        $this->addSql('ALTER TABLE horse CHANGE breed breed INT NOT NULL');
        $this->addSql('ALTER TABLE transaction CHANGE player player INT NOT NULL');
    }
}

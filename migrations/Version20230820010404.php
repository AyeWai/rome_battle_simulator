<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230820010404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE centuria (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, centurion_id INTEGER DEFAULT NULL, cohort_id INTEGER DEFAULT NULL, centuriatype_id INTEGER NOT NULL, health INTEGER NOT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_597A5EE68EDC981D FOREIGN KEY (centurion_id) REFERENCES centurion (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_597A5EE635983C93 FOREIGN KEY (cohort_id) REFERENCES cohort (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_597A5EE696DFCE7F FOREIGN KEY (centuriatype_id) REFERENCES centuria_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_597A5EE68EDC981D ON centuria (centurion_id)');
        $this->addSql('CREATE INDEX IDX_597A5EE635983C93 ON centuria (cohort_id)');
        $this->addSql('CREATE INDEX IDX_597A5EE696DFCE7F ON centuria (centuriatype_id)');
        $this->addSql('CREATE TABLE centuria_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL, melee INTEGER NOT NULL, range INTEGER NOT NULL, defense INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE centurion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, centurion_type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, age INTEGER NOT NULL, time_served INTEGER NOT NULL, CONSTRAINT FK_AFBBB34FD25E0363 FOREIGN KEY (centurion_type_id) REFERENCES centurion_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AFBBB34F5E237E06 ON centurion (name)');
        $this->addSql('CREATE INDEX IDX_AFBBB34FD25E0363 ON centurion (centurion_type_id)');
        $this->addSql('CREATE TABLE centurion_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL, meleecoeff INTEGER NOT NULL, rangecoeff INTEGER NOT NULL, defensecoeff INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE cohort (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, legio_id INTEGER DEFAULT NULL, number INTEGER NOT NULL, CONSTRAINT FK_D3B8C16B407ED876 FOREIGN KEY (legio_id) REFERENCES legio (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D3B8C16B407ED876 ON cohort (legio_id)');
        $this->addSql('CREATE TABLE legio (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE centuria');
        $this->addSql('DROP TABLE centuria_type');
        $this->addSql('DROP TABLE centurion');
        $this->addSql('DROP TABLE centurion_type');
        $this->addSql('DROP TABLE cohort');
        $this->addSql('DROP TABLE legio');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

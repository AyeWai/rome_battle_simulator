<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329004945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__centurion AS SELECT id, centurion_type_id, name, age, time_served FROM centurion');
        $this->addSql('DROP TABLE centurion');
        $this->addSql('CREATE TABLE centurion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, centurion_type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, age INTEGER NOT NULL, time_served INTEGER NOT NULL, CONSTRAINT FK_AFBBB34FD25E0363 FOREIGN KEY (centurion_type_id) REFERENCES centurion_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO centurion (id, centurion_type_id, name, age, time_served) SELECT id, centurion_type_id, name, age, time_served FROM __temp__centurion');
        $this->addSql('DROP TABLE __temp__centurion');
        $this->addSql('CREATE INDEX IDX_AFBBB34FD25E0363 ON centurion (centurion_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__centurion AS SELECT id, centurion_type_id, name, age, time_served FROM centurion');
        $this->addSql('DROP TABLE centurion');
        $this->addSql('CREATE TABLE centurion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, centurion_type_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, age INTEGER NOT NULL, time_served INTEGER NOT NULL, CONSTRAINT FK_AFBBB34FD25E0363 FOREIGN KEY (centurion_type_id) REFERENCES centurion_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO centurion (id, centurion_type_id, name, age, time_served) SELECT id, centurion_type_id, name, age, time_served FROM __temp__centurion');
        $this->addSql('DROP TABLE __temp__centurion');
        $this->addSql('CREATE INDEX IDX_AFBBB34FD25E0363 ON centurion (centurion_type_id)');
    }
}

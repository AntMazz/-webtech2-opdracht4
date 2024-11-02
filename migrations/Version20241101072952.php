<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241101072952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__boek AS SELECT id, auteur_id, titel FROM boek');
        $this->addSql('DROP TABLE boek');
        $this->addSql('CREATE TABLE boek (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auteur_id INTEGER DEFAULT NULL, titel VARCHAR(255) NOT NULL, CONSTRAINT FK_310A4BBB60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO boek (id, auteur_id, titel) SELECT id, auteur_id, titel FROM __temp__boek');
        $this->addSql('DROP TABLE __temp__boek');
        $this->addSql('CREATE INDEX IDX_310A4BBB60BB6FE6 ON boek (auteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__boek AS SELECT id, auteur_id, titel FROM boek');
        $this->addSql('DROP TABLE boek');
        $this->addSql('CREATE TABLE boek (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auteur_id INTEGER NOT NULL, titel VARCHAR(255) NOT NULL, CONSTRAINT FK_310A4BBB60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO boek (id, auteur_id, titel) SELECT id, auteur_id, titel FROM __temp__boek');
        $this->addSql('DROP TABLE __temp__boek');
        $this->addSql('CREATE INDEX IDX_310A4BBB60BB6FE6 ON boek (auteur_id)');
    }
}

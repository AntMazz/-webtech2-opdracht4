<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031202430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, naam VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE boek (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auteur_id INTEGER NOT NULL, titel VARCHAR(255) NOT NULL, CONSTRAINT FK_310A4BBB60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_310A4BBB60BB6FE6 ON boek (auteur_id)');
        $this->addSql('CREATE TABLE klant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE uitlening (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, klant_id INTEGER NOT NULL, boek_id INTEGER NOT NULL, uitgeleend_op DATETIME NOT NULL, teruggebracht_op DATETIME NOT NULL, CONSTRAINT FK_110D28CD3C427B2F FOREIGN KEY (klant_id) REFERENCES klant (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_110D28CD5C12AB20 FOREIGN KEY (boek_id) REFERENCES boek (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_110D28CD3C427B2F ON uitlening (klant_id)');
        $this->addSql('CREATE INDEX IDX_110D28CD5C12AB20 ON uitlening (boek_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE boek');
        $this->addSql('DROP TABLE klant');
        $this->addSql('DROP TABLE uitlening');
    }
}

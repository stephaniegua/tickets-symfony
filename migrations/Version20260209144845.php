<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209144845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, auteur VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, closed_at DATETIME DEFAULT NULL, description LONGTEXT NOT NULL, categorie_id INT NOT NULL, statut_id INT NOT NULL, responsabble_id INT NOT NULL, INDEX IDX_97A0ADA3BCF5E72D (categorie_id), INDEX IDX_97A0ADA3F6203804 (statut_id), INDEX IDX_97A0ADA31B4163EA (responsabble_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA31B4163EA FOREIGN KEY (responsabble_id) REFERENCES responsable (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3BCF5E72D');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3F6203804');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA31B4163EA');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE ticket');
    }
}

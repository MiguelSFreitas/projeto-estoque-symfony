<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261114191712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produto (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(150) NOT NULL, codigo VARCHAR(50) NOT NULL, descricao LONGTEXT DEFAULT NULL, preco NUMERIC(10, 2) NOT NULL, quantidade INT DEFAULT 0 NOT NULL, estoque_minimo INT DEFAULT 0 NOT NULL, ativo TINYINT DEFAULT 1 NOT NULL, criado_em DATETIME NOT NULL, categoria_id INT NOT NULL, UNIQUE INDEX UNIQ_5CAC49D720332D99 (codigo), INDEX IDX_5CAC49D73397707A (categoria_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE produto ADD CONSTRAINT FK_5CAC49D73397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produto DROP FOREIGN KEY FK_5CAC49D73397707A');
        $this->addSql('DROP TABLE produto');
    }
}

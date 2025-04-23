<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250423115200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE alerte (id INT AUTO_INCREMENT NOT NULL, bon_id INT NOT NULL, message LONGTEXT NOT NULL, date_alerte DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_3AE753AAD65737C (bon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE bon_livraison (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date_livraison DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', montant_total NUMERIC(10, 2) NOT NULL, INDEX IDX_31A531A419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, email VARCHAR(150) NOT NULL, phone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ligne_bon (id INT AUTO_INCREMENT NOT NULL, bon_livraison_id INT NOT NULL, produit_id INT DEFAULT NULL, quantity INT NOT NULL, prix_unitaire NUMERIC(10, 2) NOT NULL, INDEX IDX_2E95027FD8D16068 (bon_livraison_id), INDEX IDX_2E95027FF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, quantite_stock INT NOT NULL, prix_unitaire NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE alerte ADD CONSTRAINT FK_3AE753AAD65737C FOREIGN KEY (bon_id) REFERENCES bon_livraison (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bon_livraison ADD CONSTRAINT FK_31A531A419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ligne_bon ADD CONSTRAINT FK_2E95027FD8D16068 FOREIGN KEY (bon_livraison_id) REFERENCES bon_livraison (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ligne_bon ADD CONSTRAINT FK_2E95027FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE alerte DROP FOREIGN KEY FK_3AE753AAD65737C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE bon_livraison DROP FOREIGN KEY FK_31A531A419EB6921
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ligne_bon DROP FOREIGN KEY FK_2E95027FD8D16068
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ligne_bon DROP FOREIGN KEY FK_2E95027FF347EFB
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE alerte
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE bon_livraison
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE client
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ligne_bon
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE produit
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}

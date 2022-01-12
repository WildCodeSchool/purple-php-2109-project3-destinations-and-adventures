<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220105153449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, commission DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, lead_customer_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, reference INT DEFAULT NULL, name VARCHAR(255) NOT NULL, travelers_count INT NOT NULL, destination VARCHAR(255) NOT NULL, confirmation_date DATE NOT NULL, departure DATE NOT NULL, return_date DATE NOT NULL, total DOUBLE PRECISION DEFAULT NULL, per_person DOUBLE PRECISION DEFAULT NULL, deposit_amount DOUBLE PRECISION DEFAULT NULL, due_deposit_date DATE DEFAULT NULL, note LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_E00CEDDEAEA34913 (reference), INDEX IDX_E00CEDDE6A048787 (lead_customer_id), INDEX IDX_E00CEDDE3414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_payment (id INT AUTO_INCREMENT NOT NULL, booking_id INT NOT NULL, client_id INT NOT NULL, date DATE DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, note LONGTEXT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, mode VARCHAR(255) DEFAULT NULL, INDEX IDX_3F15C0703301C60 (booking_id), INDEX IDX_3F15C07019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, note LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier_payment (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, booking_id INT NOT NULL, due_amount DOUBLE PRECISION DEFAULT NULL, due_date DATE DEFAULT NULL, exchange_rate DOUBLE PRECISION DEFAULT NULL, due_dollars_amount DOUBLE PRECISION DEFAULT NULL, note LONGTEXT DEFAULT NULL, date DATE DEFAULT NULL, paid_amount DOUBLE PRECISION DEFAULT NULL, due_commission DOUBLE PRECISION DEFAULT NULL, due_date_commission DATE DEFAULT NULL, INDEX IDX_EC4DF0122ADD6D8C (supplier_id), INDEX IDX_EC4DF0123301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE6A048787 FOREIGN KEY (lead_customer_id) REFERENCES client (id)');
        $this->addSql('CREATE TABLE supplier_information (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, booking_id INT NOT NULL, due_amount DOUBLE PRECISION DEFAULT NULL, due_date DATE DEFAULT NULL, exchange_rate DOUBLE PRECISION DEFAULT NULL, due_dollars_amount DOUBLE PRECISION DEFAULT NULL, note LONGTEXT DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, INDEX IDX_F0CEB3922ADD6D8C (supplier_id), INDEX IDX_F0CEB3923301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE supplier_information ADD CONSTRAINT FK_F0CEB3922ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE supplier_information ADD CONSTRAINT FK_F0CEB3923301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE3414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE client_payment ADD CONSTRAINT FK_3F15C0703301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('ALTER TABLE client_payment ADD CONSTRAINT FK_3F15C07019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE supplier_payment ADD CONSTRAINT FK_EC4DF0122ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE supplier_payment ADD CONSTRAINT FK_EC4DF0123301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE3414710B');
        $this->addSql('ALTER TABLE client_payment DROP FOREIGN KEY FK_3F15C0703301C60');
        $this->addSql('ALTER TABLE supplier_payment DROP FOREIGN KEY FK_EC4DF0123301C60');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE6A048787');
        $this->addSql('ALTER TABLE client_payment DROP FOREIGN KEY FK_3F15C07019EB6921');
        $this->addSql('ALTER TABLE supplier_payment DROP FOREIGN KEY FK_EC4DF0122ADD6D8C');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_payment');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE supplier_payment');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE supplier_information');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250131111829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE about_me (id SERIAL NOT NULL, key VARCHAR(50) NOT NULL, value VARCHAR(1000) NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE application (id SERIAL NOT NULL, name VARCHAR(160) NOT NULL, description VARCHAR(3000) NOT NULL, logo VARCHAR(100) DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE company_data (id SERIAL NOT NULL, user_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, street_number VARCHAR(255) NOT NULL, flat_number VARCHAR(10) DEFAULT NULL, post_code VARCHAR(10) NOT NULL, city VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EE9EE98D9D86650F ON company_data (user_id_id)');
        $this->addSql('CREATE TABLE "group" (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE information_about_me (id SERIAL NOT NULL, key VARCHAR(20) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE invoice (id SERIAL NOT NULL, user_id_id INT NOT NULL, company_name VARCHAR(255) NOT NULL, company_street VARCHAR(100) NOT NULL, company_street_number VARCHAR(10) NOT NULL, company_street_flat_number VARCHAR(10) DEFAULT NULL, company_city VARCHAR(100) NOT NULL, company_post_code VARCHAR(10) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, email VARCHAR(35) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, tax_number VARCHAR(16) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_906517449D86650F ON invoice (user_id_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE user_data (id SERIAL NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_group (id SERIAL NOT NULL, user_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE company_data ADD CONSTRAINT FK_EE9EE98D9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517449D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE company_data DROP CONSTRAINT FK_EE9EE98D9D86650F');
        $this->addSql('ALTER TABLE invoice DROP CONSTRAINT FK_906517449D86650F');
        $this->addSql('DROP TABLE about_me');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE company_data');
        $this->addSql('DROP TABLE "group"');
        $this->addSql('DROP TABLE information_about_me');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_data');
        $this->addSql('DROP TABLE user_group');
    }
}

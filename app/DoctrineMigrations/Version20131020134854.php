<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131020134854 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE cart_order (id INT AUTO_INCREMENT NOT NULL, cart_id INT NOT NULL, user_id INT DEFAULT NULL, fio VARCHAR(255) NOT NULL, town VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, paymentType VARCHAR(255) NOT NULL, comments VARCHAR(255) NOT NULL, deliveryType VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, INDEX IDX_AAC3FE901AD5CDBF (cart_id), INDEX IDX_AAC3FE90A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE cart_order ADD CONSTRAINT FK_AAC3FE901AD5CDBF FOREIGN KEY (cart_id) REFERENCES Cart (id)");
        $this->addSql("ALTER TABLE cart_order ADD CONSTRAINT FK_AAC3FE90A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE cart_order");
    }
}

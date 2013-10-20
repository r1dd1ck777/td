<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131020181804 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE `Order`");
        $this->addSql("ALTER TABLE cart_order CHANGE comments comments VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE Mention ADD product_id INT NOT NULL");
        $this->addSql("ALTER TABLE Mention ADD CONSTRAINT FK_2DBF60514584665A FOREIGN KEY (product_id) REFERENCES Product (id)");
        $this->addSql("CREATE INDEX IDX_2DBF60514584665A ON Mention (product_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE `Order` (id INT AUTO_INCREMENT NOT NULL, cart_id INT NOT NULL, user_id INT DEFAULT NULL, fio VARCHAR(255) NOT NULL, town VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, paymentType VARCHAR(255) NOT NULL, comments VARCHAR(255) NOT NULL, deliveryType VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, INDEX IDX_34E8BC9C1AD5CDBF (cart_id), INDEX IDX_34E8BC9CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE Mention DROP FOREIGN KEY FK_2DBF60514584665A");
        $this->addSql("DROP INDEX IDX_2DBF60514584665A ON Mention");
        $this->addSql("ALTER TABLE Mention DROP product_id");
        $this->addSql("ALTER TABLE cart_order CHANGE comments comments VARCHAR(255) NOT NULL");
    }
}

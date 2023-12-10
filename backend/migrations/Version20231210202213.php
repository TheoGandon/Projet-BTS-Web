<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231210202213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, address_street VARCHAR(255) NOT NULL, address_street2 VARCHAR(255) DEFAULT NULL, address_postal_code VARCHAR(255) NOT NULL, address_city VARCHAR(255) NOT NULL, address_country VARCHAR(255) NOT NULL, address_phone_number VARCHAR(255) NOT NULL, INDEX IDX_D4E6F81DC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_picture (id INT AUTO_INCREMENT NOT NULL, article_id_id INT NOT NULL, color_id_id INT NOT NULL, picture_link VARCHAR(255) NOT NULL, INDEX IDX_FB090B3E8F3EC46 (article_id_id), INDEX IDX_FB090B3EE88CCE5 (color_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, category_id_id INT NOT NULL, article_title VARCHAR(255) NOT NULL, article_description VARCHAR(1024) NOT NULL, article_selling_price DOUBLE PRECISION NOT NULL, article_selling_price_promotion DOUBLE PRECISION NOT NULL, INDEX IDX_BFDD31689777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles_sizes (articles_id INT NOT NULL, sizes_id INT NOT NULL, INDEX IDX_5E7CAF9D1EBAF6CC (articles_id), INDEX IDX_5E7CAF9D423285E6 (sizes_id), PRIMARY KEY(articles_id, sizes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carrier (id INT AUTO_INCREMENT NOT NULL, carrier_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, client_first_name VARCHAR(255) NOT NULL, client_last_name VARCHAR(255) NOT NULL, client_email VARCHAR(255) NOT NULL, client_password VARCHAR(512) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_articles (client_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_913B01AD19EB6921 (client_id), INDEX IDX_913B01AD1EBAF6CC (articles_id), PRIMARY KEY(client_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, array_articles_id INT DEFAULT NULL, color_label VARCHAR(255) NOT NULL, INDEX IDX_665648E9DCD10AD9 (array_articles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, order_datetime DATETIME NOT NULL, order_status INT NOT NULL, INDEX IDX_F5299398DC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_articles (order_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_5E25D3D98D9F6D38 (order_id), INDEX IDX_5E25D3D91EBAF6CC (articles_id), PRIMARY KEY(order_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, payment_method INT NOT NULL, payment_txid VARCHAR(255) NOT NULL, payment_status VARCHAR(20) NOT NULL, INDEX IDX_6D28840DFCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipping (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, carrier_id_id INT NOT NULL, shipping_tracking_number VARCHAR(30) NOT NULL, INDEX IDX_2D1C1724FCDAEAAA (order_id_id), INDEX IDX_2D1C1724CCAE5A8 (carrier_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sizes (id INT AUTO_INCREMENT NOT NULL, size_label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3E8F3EC46 FOREIGN KEY (article_id_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3EE88CCE5 FOREIGN KEY (color_id_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31689777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE articles_sizes ADD CONSTRAINT FK_5E7CAF9D1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_sizes ADD CONSTRAINT FK_5E7CAF9D423285E6 FOREIGN KEY (sizes_id) REFERENCES sizes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_articles ADD CONSTRAINT FK_913B01AD19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_articles ADD CONSTRAINT FK_913B01AD1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE color ADD CONSTRAINT FK_665648E9DCD10AD9 FOREIGN KEY (array_articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE order_articles ADD CONSTRAINT FK_5E25D3D98D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_articles ADD CONSTRAINT FK_5E25D3D91EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE shipping ADD CONSTRAINT FK_2D1C1724FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE shipping ADD CONSTRAINT FK_2D1C1724CCAE5A8 FOREIGN KEY (carrier_id_id) REFERENCES carrier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81DC2902E0');
        $this->addSql('ALTER TABLE article_picture DROP FOREIGN KEY FK_FB090B3E8F3EC46');
        $this->addSql('ALTER TABLE article_picture DROP FOREIGN KEY FK_FB090B3EE88CCE5');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31689777D11E');
        $this->addSql('ALTER TABLE articles_sizes DROP FOREIGN KEY FK_5E7CAF9D1EBAF6CC');
        $this->addSql('ALTER TABLE articles_sizes DROP FOREIGN KEY FK_5E7CAF9D423285E6');
        $this->addSql('ALTER TABLE client_articles DROP FOREIGN KEY FK_913B01AD19EB6921');
        $this->addSql('ALTER TABLE client_articles DROP FOREIGN KEY FK_913B01AD1EBAF6CC');
        $this->addSql('ALTER TABLE color DROP FOREIGN KEY FK_665648E9DCD10AD9');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398DC2902E0');
        $this->addSql('ALTER TABLE order_articles DROP FOREIGN KEY FK_5E25D3D98D9F6D38');
        $this->addSql('ALTER TABLE order_articles DROP FOREIGN KEY FK_5E25D3D91EBAF6CC');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DFCDAEAAA');
        $this->addSql('ALTER TABLE shipping DROP FOREIGN KEY FK_2D1C1724FCDAEAAA');
        $this->addSql('ALTER TABLE shipping DROP FOREIGN KEY FK_2D1C1724CCAE5A8');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE article_picture');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE articles_sizes');
        $this->addSql('DROP TABLE carrier');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_articles');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_articles');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE shipping');
        $this->addSql('DROP TABLE sizes');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

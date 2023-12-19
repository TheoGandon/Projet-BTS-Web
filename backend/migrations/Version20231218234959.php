<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218234959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_article_picture (article_id INT NOT NULL, article_picture_id INT NOT NULL, INDEX IDX_18CC3BA07294869C (article_id), INDEX IDX_18CC3BA0D29C6C3E (article_picture_id), PRIMARY KEY(article_id, article_picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_order (article_id INT NOT NULL, order_id INT NOT NULL, INDEX IDX_829EE1897294869C (article_id), INDEX IDX_829EE1898D9F6D38 (order_id), PRIMARY KEY(article_id, order_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_client (article_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_AD8393D57294869C (article_id), INDEX IDX_AD8393D519EB6921 (client_id), PRIMARY KEY(article_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_article_picture ADD CONSTRAINT FK_18CC3BA07294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_article_picture ADD CONSTRAINT FK_18CC3BA0D29C6C3E FOREIGN KEY (article_picture_id) REFERENCES article_picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_order ADD CONSTRAINT FK_829EE1897294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_order ADD CONSTRAINT FK_829EE1898D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_client ADD CONSTRAINT FK_AD8393D57294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_client ADD CONSTRAINT FK_AD8393D519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD article_title VARCHAR(255) NOT NULL, ADD article_description VARCHAR(1024) NOT NULL, ADD selling_price NUMERIC(8, 2) NOT NULL, ADD selling_price_promo NUMERIC(8, 2) NOT NULL');
        $this->addSql('ALTER TABLE article_picture DROP FOREIGN KEY FK_FB090B3E8F3EC46');
        $this->addSql('DROP INDEX IDX_FB090B3E8F3EC46 ON article_picture');
        $this->addSql('ALTER TABLE article_picture DROP article_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_article_picture DROP FOREIGN KEY FK_18CC3BA07294869C');
        $this->addSql('ALTER TABLE article_article_picture DROP FOREIGN KEY FK_18CC3BA0D29C6C3E');
        $this->addSql('ALTER TABLE article_order DROP FOREIGN KEY FK_829EE1897294869C');
        $this->addSql('ALTER TABLE article_order DROP FOREIGN KEY FK_829EE1898D9F6D38');
        $this->addSql('ALTER TABLE article_client DROP FOREIGN KEY FK_AD8393D57294869C');
        $this->addSql('ALTER TABLE article_client DROP FOREIGN KEY FK_AD8393D519EB6921');
        $this->addSql('DROP TABLE article_article_picture');
        $this->addSql('DROP TABLE article_order');
        $this->addSql('DROP TABLE article_client');
        $this->addSql('ALTER TABLE article DROP article_title, DROP article_description, DROP selling_price, DROP selling_price_promo');
        $this->addSql('ALTER TABLE article_picture ADD article_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_picture ADD CONSTRAINT FK_FB090B3E8F3EC46 FOREIGN KEY (article_id_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_FB090B3E8F3EC46 ON article_picture (article_id_id)');
    }
}

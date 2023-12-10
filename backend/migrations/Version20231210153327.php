<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231210153327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carrier (id INT AUTO_INCREMENT NOT NULL, carrier_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_articles (order_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_5E25D3D98D9F6D38 (order_id), INDEX IDX_5E25D3D91EBAF6CC (articles_id), PRIMARY KEY(order_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipping (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, carrier_id_id INT NOT NULL, shipping_tracking_number VARCHAR(30) NOT NULL, INDEX IDX_2D1C1724FCDAEAAA (order_id_id), INDEX IDX_2D1C1724CCAE5A8 (carrier_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_articles ADD CONSTRAINT FK_5E25D3D98D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_articles ADD CONSTRAINT FK_5E25D3D91EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shipping ADD CONSTRAINT FK_2D1C1724FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE shipping ADD CONSTRAINT FK_2D1C1724CCAE5A8 FOREIGN KEY (carrier_id_id) REFERENCES carrier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_articles DROP FOREIGN KEY FK_5E25D3D98D9F6D38');
        $this->addSql('ALTER TABLE order_articles DROP FOREIGN KEY FK_5E25D3D91EBAF6CC');
        $this->addSql('ALTER TABLE shipping DROP FOREIGN KEY FK_2D1C1724FCDAEAAA');
        $this->addSql('ALTER TABLE shipping DROP FOREIGN KEY FK_2D1C1724CCAE5A8');
        $this->addSql('DROP TABLE carrier');
        $this->addSql('DROP TABLE order_articles');
        $this->addSql('DROP TABLE shipping');
    }
}

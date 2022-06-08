<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606112615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poll_option ADD poll_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poll_option ADD CONSTRAINT FK_B68343EB3C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id)');
        $this->addSql('CREATE INDEX IDX_B68343EB3C947C0F ON poll_option (poll_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poll_option DROP FOREIGN KEY FK_B68343EB3C947C0F');
        $this->addSql('DROP INDEX IDX_B68343EB3C947C0F ON poll_option');
        $this->addSql('ALTER TABLE poll_option DROP poll_id');
    }
}

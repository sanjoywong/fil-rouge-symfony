<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107142908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrateurs DROP FOREIGN KEY FK_B5ED4E1372F0DA07');
        $this->addSql('DROP INDEX uniq_b5ed4e1372f0da07 ON administrateurs');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B5ED4E13F2C56620 ON administrateurs (compte_id)');
        $this->addSql('ALTER TABLE administrateurs ADD CONSTRAINT FK_B5ED4E1372F0DA07 FOREIGN KEY (compte_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CF88F188A');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C305C84E6');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C8CEBACA0');
        $this->addSql('DROP INDEX idx_fdca8c9c8cebaca0 ON cours');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CDC304035 ON cours (salle_id)');
        $this->addSql('DROP INDEX idx_fdca8c9c305c84e6 ON cours');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C139DF194 ON cours (promotion_id)');
        $this->addSql('DROP INDEX idx_fdca8c9cf88f188a ON cours');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CDB4E6DF8 ON cours (enseigant_id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CF88F188A FOREIGN KEY (enseigant_id) REFERENCES enseignants (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C305C84E6 FOREIGN KEY (promotion_id) REFERENCES promotions (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C8CEBACA0 FOREIGN KEY (salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B1305C84E6');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B172F0DA07');
        $this->addSql('DROP INDEX idx_383b09b1305c84e6 ON eleves');
        $this->addSql('CREATE INDEX IDX_383B09B1139DF194 ON eleves (promotion_id)');
        $this->addSql('DROP INDEX uniq_383b09b172f0da07 ON eleves');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_383B09B1F2C56620 ON eleves (compte_id)');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B1305C84E6 FOREIGN KEY (promotion_id) REFERENCES promotions (id)');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B172F0DA07 FOREIGN KEY (compte_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE enseignants DROP FOREIGN KEY FK_BA5EFB5A72F0DA07');
        $this->addSql('DROP INDEX uniq_ba5efb5a72f0da07 ON enseignants');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA5EFB5AF2C56620 ON enseignants (compte_id)');
        $this->addSql('ALTER TABLE enseignants ADD CONSTRAINT FK_BA5EFB5A72F0DA07 FOREIGN KEY (compte_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B30341CE947F9');
        $this->addSql('ALTER TABLE promotions CHANGE etablissement_id etablissement_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX idx_ea1b30341ce947f9 ON promotions');
        $this->addSql('CREATE INDEX IDX_EA1B3034FF631228 ON promotions (etablissement_id)');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B30341CE947F9 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id)');
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AA1CE947F9');
        $this->addSql('DROP INDEX idx_799d45aa1ce947f9 ON salles');
        $this->addSql('CREATE INDEX IDX_799D45AAFF631228 ON salles (etablissement_id)');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AA1CE947F9 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrateurs DROP FOREIGN KEY FK_B5ED4E13F2C56620');
        $this->addSql('DROP INDEX uniq_b5ed4e13f2c56620 ON administrateurs');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B5ED4E1372F0DA07 ON administrateurs (compte_id)');
        $this->addSql('ALTER TABLE administrateurs ADD CONSTRAINT FK_B5ED4E13F2C56620 FOREIGN KEY (compte_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CDC304035');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C139DF194');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CDB4E6DF8');
        $this->addSql('DROP INDEX idx_fdca8c9cdc304035 ON cours');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C8CEBACA0 ON cours (salle_id)');
        $this->addSql('DROP INDEX idx_fdca8c9c139df194 ON cours');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C305C84E6 ON cours (promotion_id)');
        $this->addSql('DROP INDEX idx_fdca8c9cdb4e6df8 ON cours');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CF88F188A ON cours (enseigant_id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CDC304035 FOREIGN KEY (salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C139DF194 FOREIGN KEY (promotion_id) REFERENCES promotions (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CDB4E6DF8 FOREIGN KEY (enseigant_id) REFERENCES enseignants (id)');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B1139DF194');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B1F2C56620');
        $this->addSql('DROP INDEX idx_383b09b1139df194 ON eleves');
        $this->addSql('CREATE INDEX IDX_383B09B1305C84E6 ON eleves (promotion_id)');
        $this->addSql('DROP INDEX uniq_383b09b1f2c56620 ON eleves');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_383B09B172F0DA07 ON eleves (compte_id)');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B1139DF194 FOREIGN KEY (promotion_id) REFERENCES promotions (id)');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B1F2C56620 FOREIGN KEY (compte_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE enseignants DROP FOREIGN KEY FK_BA5EFB5AF2C56620');
        $this->addSql('DROP INDEX uniq_ba5efb5af2c56620 ON enseignants');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA5EFB5A72F0DA07 ON enseignants (compte_id)');
        $this->addSql('ALTER TABLE enseignants ADD CONSTRAINT FK_BA5EFB5AF2C56620 FOREIGN KEY (compte_id) REFERENCES comptes (id)');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B3034FF631228');
        $this->addSql('ALTER TABLE promotions CHANGE etablissement_id etablissement_id INT NOT NULL');
        $this->addSql('DROP INDEX idx_ea1b3034ff631228 ON promotions');
        $this->addSql('CREATE INDEX IDX_EA1B30341CE947F9 ON promotions (etablissement_id)');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B3034FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id)');
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AAFF631228');
        $this->addSql('DROP INDEX idx_799d45aaff631228 ON salles');
        $this->addSql('CREATE INDEX IDX_799D45AA1CE947F9 ON salles (etablissement_id)');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AAFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109111531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, salle_id INT DEFAULT NULL, promotion_id INT DEFAULT NULL, enseigant_id INT DEFAULT NULL, date DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, nom_matiere VARCHAR(255) DEFAULT NULL, INDEX IDX_FDCA8C9CDC304035 (salle_id), INDEX IDX_FDCA8C9C139DF194 (promotion_id), INDEX IDX_FDCA8C9CDB4E6DF8 (enseigant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_eleves (cours_id INT NOT NULL, eleves_id INT NOT NULL, INDEX IDX_57BB18D97ECF78B0 (cours_id), INDEX IDX_57BB18D9C2140342 (eleves_id), PRIMARY KEY(cours_id, eleves_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleves (id INT AUTO_INCREMENT NOT NULL, promotion_id INT DEFAULT NULL, user_id INT NOT NULL, INDEX IDX_383B09B1139DF194 (promotion_id), UNIQUE INDEX UNIQ_383B09B1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignants (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_BA5EFB5AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissements (id INT AUTO_INCREMENT NOT NULL, nom_etablissement VARCHAR(255) NOT NULL, ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres (id INT AUTO_INCREMENT NOT NULL, nom_matiere VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres_enseignants (matieres_id INT NOT NULL, enseignants_id INT NOT NULL, INDEX IDX_87C9A2AD82350831 (matieres_id), INDEX IDX_87C9A2AD7CF12A69 (enseignants_id), PRIMARY KEY(matieres_id, enseignants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotions (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT DEFAULT NULL, nom_promotion VARCHAR(255) NOT NULL, annee INT DEFAULT NULL, INDEX IDX_EA1B3034FF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salles (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT NOT NULL, nom_salle VARCHAR(255) NOT NULL, caracteristique VARCHAR(255) DEFAULT NULL, INDEX IDX_799D45AAFF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, identifiant VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE DEFAULT NULL, telephone VARCHAR(10) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649C90409EC (identifiant), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CDC304035 FOREIGN KEY (salle_id) REFERENCES salles (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C139DF194 FOREIGN KEY (promotion_id) REFERENCES promotions (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CDB4E6DF8 FOREIGN KEY (enseigant_id) REFERENCES enseignants (id)');
        $this->addSql('ALTER TABLE cours_eleves ADD CONSTRAINT FK_57BB18D97ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_eleves ADD CONSTRAINT FK_57BB18D9C2140342 FOREIGN KEY (eleves_id) REFERENCES eleves (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B1139DF194 FOREIGN KEY (promotion_id) REFERENCES promotions (id)');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE enseignants ADD CONSTRAINT FK_BA5EFB5AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE matieres_enseignants ADD CONSTRAINT FK_87C9A2AD82350831 FOREIGN KEY (matieres_id) REFERENCES matieres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matieres_enseignants ADD CONSTRAINT FK_87C9A2AD7CF12A69 FOREIGN KEY (enseignants_id) REFERENCES enseignants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B3034FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id)');
        $this->addSql('ALTER TABLE salles ADD CONSTRAINT FK_799D45AAFF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CDC304035');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C139DF194');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CDB4E6DF8');
        $this->addSql('ALTER TABLE cours_eleves DROP FOREIGN KEY FK_57BB18D97ECF78B0');
        $this->addSql('ALTER TABLE cours_eleves DROP FOREIGN KEY FK_57BB18D9C2140342');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B1139DF194');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B1A76ED395');
        $this->addSql('ALTER TABLE enseignants DROP FOREIGN KEY FK_BA5EFB5AA76ED395');
        $this->addSql('ALTER TABLE matieres_enseignants DROP FOREIGN KEY FK_87C9A2AD82350831');
        $this->addSql('ALTER TABLE matieres_enseignants DROP FOREIGN KEY FK_87C9A2AD7CF12A69');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B3034FF631228');
        $this->addSql('ALTER TABLE salles DROP FOREIGN KEY FK_799D45AAFF631228');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE cours_eleves');
        $this->addSql('DROP TABLE eleves');
        $this->addSql('DROP TABLE enseignants');
        $this->addSql('DROP TABLE etablissements');
        $this->addSql('DROP TABLE matieres');
        $this->addSql('DROP TABLE matieres_enseignants');
        $this->addSql('DROP TABLE promotions');
        $this->addSql('DROP TABLE salles');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

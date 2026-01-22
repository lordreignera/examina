<?php

namespace Database\Seeders;

use App\Models\SpecimenType;
use App\Models\LabTest;
use App\Models\TestCategory;
use App\Models\Branch;
use Illuminate\Database\Seeder;

class LabTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Specimen Types
        $serum = SpecimenType::create([
            'specimen_name' => 'Serum',
            'description' => 'Blood serum sample',
        ]);

        $plasma = SpecimenType::create([
            'specimen_name' => 'Plasma',
            'description' => 'Blood plasma sample',
        ]);

        $wholeBlood = SpecimenType::create([
            'specimen_name' => 'Whole Blood',
            'description' => 'Whole blood sample',
        ]);

        $urine = SpecimenType::create([
            'specimen_name' => 'Urine',
            'description' => 'Urine sample',
        ]);

        $skinPrick = SpecimenType::create([
            'specimen_name' => 'Skin Prick',
            'description' => 'Skin prick sample',
        ]);

        $swab = SpecimenType::create([
            'specimen_name' => 'Swab',
            'description' => 'Swab sample',
        ]);

        // Get branches
        $kampala = Branch::where('branch_name', 'LIKE', '%Kampala%')->first();
        $entebbe = Branch::where('branch_name', 'LIKE', '%Entebbe%')->first();
        $mbarara = Branch::where('branch_name', 'LIKE', '%Mbarara%')->first();
        $gulu = Branch::where('branch_name', 'LIKE', '%Gulu%')->first();
        $jinja = Branch::where('branch_name', 'LIKE', '%Jinja%')->first();

        // Create Main LabTests (NO hierarchy, NO parent_id)
        $allergy = LabTest::create([
            'test_name' => 'Allergy',
            'description' => 'Allergy testing services',
            'status' => 'active',
        ]);

        $hivTesting = LabTest::create([
            'test_name' => 'HIV Testing',
            'description' => 'HIV testing services',
            'status' => 'active',
        ]);

        $bloodTests = LabTest::create([
            'test_name' => 'Blood Tests',
            'description' => 'Blood testing services',
            'status' => 'active',
        ]);

        // Create hierarchical TestCategories under Allergy
        // Level 1: Individual allergens (parent)
        $individualAllergens = TestCategory::create([
            'category_name' => 'Individual allergens',
            'description' => 'Individual allergen testing',
            'lab_test_id' => $allergy->id,
            'parent_id' => null,
            'specimen_id' => null,
            'price' => 0,
            'level' => 1,
        ]);

        // Level 2: Allergen-Specific IgG, Serum (parent under Individual allergens)
        $allergenIgG = TestCategory::create([
            'category_name' => 'Allergen-Specific IgG, Serum',
            'description' => 'Allergen-specific IgG tests in serum',
            'lab_test_id' => $allergy->id,
            'parent_id' => $individualAllergens->id,
            'specimen_id' => $serum->id,
            'price' => 0,
            'level' => 2,
        ]);

        // Level 3: IgG specific tests (test_code auto-generated)
        $aspergillusIgG = TestCategory::create([
            'category_name' => 'Aspergillus fumigatus (Specific IgG)',
            'description' => 'Aspergillus fumigatus specific IgG test',
            'lab_test_id' => $allergy->id,
            'parent_id' => $allergenIgG->id,
            'specimen_id' => $serum->id,
            'price' => 85000,
            'level' => 3,
        ]);

        $penicillinIgG = TestCategory::create([
            'category_name' => 'Penicillin G (Specific IgG)',
            'description' => 'Penicillin G specific IgG test',
            'lab_test_id' => $allergy->id,
            'parent_id' => $allergenIgG->id,
            'specimen_id' => $serum->id,
            'price' => 85000,
            'level' => 3,
        ]);

        // Level 2: Allergy-Screening, Serum (leaf test)
        $allergyScreening = TestCategory::create([
            'category_name' => 'Allergy-Screening, Serum',
            'description' => 'General allergy screening in serum',
            'lab_test_id' => $allergy->id,
            'parent_id' => $individualAllergens->id,
            'specimen_id' => $serum->id,
            'price' => 120000,
            'level' => 2,
        ]);

        // Level 2: Animal Allergen-Specific IgE, Serum (parent)
        $animalIgE = TestCategory::create([
            'category_name' => 'Animal Allergen-Specific IgE, Serum',
            'description' => 'Animal allergen-specific IgE tests',
            'lab_test_id' => $allergy->id,
            'parent_id' => $individualAllergens->id,
            'specimen_id' => $serum->id,
            'price' => 0,
            'level' => 2,
        ]);

        // Level 3: Animal IgE tests (test_code auto-generated)
        $catDander = TestCategory::create([
            'category_name' => 'Cat Dander (IgE)',
            'description' => 'Cat dander specific IgE test',
            'lab_test_id' => $allergy->id,
            'parent_id' => $animalIgE->id,
            'specimen_id' => $serum->id,
            'price' => 75000,
            'level' => 3,
        ]);

        $dogDander = TestCategory::create([
            'category_name' => 'Dog Dander (IgE)',
            'description' => 'Dog dander specific IgE test',
            'lab_test_id' => $allergy->id,
            'parent_id' => $animalIgE->id,
            'specimen_id' => $serum->id,
            'price' => 75000,
            'level' => 3,
        ]);

        // Level 2: Food Allergen-Specific IgE, Serum (parent)
        $foodIgE = TestCategory::create([
            'category_name' => 'Food Allergen-Specific IgE, Serum',
            'description' => 'Food allergen-specific IgE tests',
            'lab_test_id' => $allergy->id,
            'parent_id' => $individualAllergens->id,
            'specimen_id' => $serum->id,
            'price' => 0,
            'level' => 2,
        ]);

        // Level 3: Food IgE tests (test_code auto-generated)
        $peanut = TestCategory::create([
            'category_name' => 'Peanut (IgE)',
            'description' => 'Peanut specific IgE test',
            'lab_test_id' => $allergy->id,
            'parent_id' => $foodIgE->id,
            'specimen_id' => $serum->id,
            'price' => 80000,
            'level' => 3,
        ]);

        $milk = TestCategory::create([
            'category_name' => 'Milk (IgE)',
            'description' => 'Milk specific IgE test',
            'lab_test_id' => $allergy->id,
            'parent_id' => $foodIgE->id,
            'specimen_id' => $serum->id,
            'price' => 80000,
            'level' => 3,
        ]);

        // Create simple TestCategories under HIV Testing (level 1, no parent)
        $hivAntibody = TestCategory::create([
            'category_name' => 'HIV 1/2 Antibody Test',
            'description' => 'HIV 1 and 2 antibody detection',
            'lab_test_id' => $hivTesting->id,
            'parent_id' => null,
            'specimen_id' => $serum->id,
            'price' => 30000,
            'level' => 1,
        ]);

        $hivViralLoad = TestCategory::create([
            'category_name' => 'HIV Viral Load',
            'description' => 'Quantitative HIV RNA viral load test',
            'lab_test_id' => $hivTesting->id,
            'parent_id' => null,
            'specimen_id' => $plasma->id,
            'price' => 200000,
            'level' => 1,
        ]);

        // Create simple TestCategories under Blood Tests (level 1, no parent)
        $cbc = TestCategory::create([
            'category_name' => 'Complete Blood Count (CBC)',
            'description' => 'Complete blood cell count and analysis',
            'lab_test_id' => $bloodTests->id,
            'parent_id' => null,
            'specimen_id' => $wholeBlood->id,
            'price' => 15000,
            'level' => 1,
        ]);

        $bloodType = TestCategory::create([
            'category_name' => 'Blood Type & Rh Factor',
            'description' => 'Determine blood type and Rh factor',
            'lab_test_id' => $bloodTests->id,
            'parent_id' => null,
            'specimen_id' => $wholeBlood->id,
            'price' => 10000,
            'level' => 1,
        ]);

        // Assign lab tests to branches
        // Kampala: all tests
        if ($kampala) {
            $allLabTests = [$allergy, $hivTesting, $bloodTests];
            foreach ($allLabTests as $test) {
                $test->branches()->attach($kampala->id);
            }
        }

        // Entebbe: HIV and Blood tests
        if ($entebbe) {
            $entebbeTests = [$hivTesting, $bloodTests];
            foreach ($entebbeTests as $test) {
                $test->branches()->attach($entebbe->id);
            }
        }

        // Mbarara: Blood tests only
        if ($mbarara) {
            $mbarara->labTests()->attach($bloodTests->id);
        }

        // Gulu: Blood tests only
        if ($gulu) {
            $gulu->labTests()->attach($bloodTests->id);
        }

        // Jinja: Blood tests only
        if ($jinja) {
            $jinja->labTests()->attach($bloodTests->id);
        }
    }
}

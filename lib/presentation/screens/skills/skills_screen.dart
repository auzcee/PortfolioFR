// lib/presentation/screens/skills/skills_screen.dart
// ─────────────────────────────────────────────────────────────────────────────
// Skills tab – Sprint 1 placeholder.
// TODO (Sprint 4): skill chips with proficiency bars, category grouping.
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/material.dart';
import 'package:portfolioph/presentation/widgets/common/placeholder_tab_body.dart';

class SkillsScreen extends StatelessWidget {
  const SkillsScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Skills')),
      body: const PlaceholderTabBody(
        icon: Icons.bar_chart_rounded,
        title: 'Skills',
        subtitle:
            'Sprint 4 will add skill chips,\nproficiency bars, and category filters.',
      ),
      floatingActionButton: FloatingActionButton(
        heroTag: 'fab_skills',
        onPressed: () {
          // TODO (Sprint 4): add skill dialog
        },
        tooltip: 'Add Skill',
        child: const Icon(Icons.add),
      ),
    );
  }
}

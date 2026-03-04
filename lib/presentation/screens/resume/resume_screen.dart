// lib/presentation/screens/resume/resume_screen.dart
// ─────────────────────────────────────────────────────────────────────────────
// Resume tab – Sprint 1 placeholder.
// TODO (Sprint 4): education, work-experience, certifications timeline.
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/material.dart';
import 'package:portfolioph/presentation/widgets/common/placeholder_tab_body.dart';

class ResumeScreen extends StatelessWidget {
  const ResumeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Resume')),
      body: const PlaceholderTabBody(
        icon: Icons.description_rounded,
        title: 'Resume',
        subtitle:
            'Sprint 4 will add education, work experience,\ncertifications, and PDF export.',
      ),
    );
  }
}

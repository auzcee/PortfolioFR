// lib/presentation/screens/portfolio/portfolio_screen.dart
// ─────────────────────────────────────────────────────────────────────────────
// Portfolio tab – Sprint 1 placeholder.
// TODO (Sprint 3): List/create/edit portfolios with project cards.
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/material.dart';
import 'package:portfolioph/presentation/widgets/common/placeholder_tab_body.dart';

class PortfolioScreen extends StatelessWidget {
  const PortfolioScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Portfolio')),
      body: const PlaceholderTabBody(
        icon: Icons.folder_rounded,
        title: 'Portfolio',
        subtitle:
            'Sprint 3 will add portfolio creation,\nproject cards, and template picker.',
      ),
      floatingActionButton: FloatingActionButton(
        heroTag: 'fab_portfolio',
        onPressed: () {
          // TODO (Sprint 3): navigate to add portfolio screen
        },
        tooltip: 'Add Portfolio',
        child: const Icon(Icons.add),
      ),
    );
  }
}
